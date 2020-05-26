<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\submissions\submissionsModel;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //

    public function OpenAcceptedPapers(Request $request)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10),403);
        $accepted_submissions = submissionsModel::where('submission_status', 4)->orderBy('updated_at', 'DESC')->paginate(10);
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.accepted', compact('accepted_submissions', 'has_profile'));
    }
    public function openRejectedPapers(Request $request)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10),403);
        $rejected_submissions = submissionsModel::where('submission_status', 3)->orderBy('updated_at', 'DESC')->paginate(10);
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.rejected', compact('rejected_submissions', 'has_profile'));
    }
    public function openResentPapers(Request $request)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10),403);
        $resent_submissions = submissionsModel::where('submission_status', 2)->orderBy('updated_at', 'DESC')->paginate(10);
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.resent', compact('resent_submissions', 'has_profile'));
    }
    public function openPendingPapers(Request $request)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10),403);
        $pending_submission = submissionsModel::where('submission_status', 0)
            ->orWhere('submission_status', 1)->orderBy('updated_at', 'DESC')->get();
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.pending', compact('pending_submission', 'has_profile'));
    }

    public function viewUserPaper(Request $request, $sub_id)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10),403);
        $view_sub = submissionsModel::where([
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }

        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $submission = $view_sub[0];
        return view('submissions.view', compact('submission', 'has_profile'));
    }
}
