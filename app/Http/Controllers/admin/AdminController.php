<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\submissions\submissionsModel;
use App\Notifications\submission\SubmissionUnderReviewNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    //

    public function OpenAcceptedPapers(Request $request)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10), 403);
        $accepted_submissions = submissionsModel::where('submission_status', 4)->orderBy('updated_at', 'DESC')->paginate(10);
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.accepted', compact('accepted_submissions', 'has_profile'));
    }
    public function openRejectedPapers(Request $request)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10), 403);
        $rejected_submissions = submissionsModel::where('submission_status', 3)->orderBy('updated_at', 'DESC')->paginate(10);
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.rejected', compact('rejected_submissions', 'has_profile'));
    }
    public function openResentPapers(Request $request)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10), 403);
        $resent_submissions = submissionsModel::where('submission_status', 2)->orderBy('updated_at', 'DESC')->paginate(10);
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.resent', compact('resent_submissions', 'has_profile'));
    }
    public function openPendingPapers(Request $request)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10), 403);
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
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 10), 403);
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

    public function SetStatusReview(Request $request, $sub_id)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 30), 403);

        $rule = ["submission" => "required|integer|exists:submissions,id"];
        $data = $request->validate($rule);
        
        if ($sub_id != $request->submission) {
            return Redirect::back()->withErrors(['submission' => 'Sorry. The submission provided do not match with the submitted form']);
        }

        $view_sub = submissionsModel::where([
            ['id', $sub_id],
        ])->get();
        abort_if($view_sub->count() <= 0, 404);
        $submitter = User::where("id", $view_sub[0]->user_id)->get();
        if($submitter == null || $submitter->count() <= 0)
            return Redirect::back()->withErrors(['submission' => 'Could not find the user who submitted this paper']);
        $updated_sub = $view_sub[0]->update(["submission_status" => $view_sub[0]->status_under_review]);
        $submitter[0]->notify(new SubmissionUnderReviewNotification($submitter[0], $view_sub[0]));
        $view_sub[0]->UpdateStatusTracker($view_sub[0]->status_under_review);
        return Redirect::back()->with('success', 'Success updated the status to under review');
    }


    public function ResendSubmissionPage(Request $request, $sub_id)
    {
        return $this->ResendRejectValidation($request, $sub_id);
    }

    public function RejectSubmissionPage(Request $request, $sub_id)
    {
        return $this->ResendRejectValidation($request, $sub_id,3);
    }

    protected function ResendRejectValidation($request, $sub_id, $status=2)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 30), 403);
        $view_sub = submissionsModel::where([
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }

        $submitter = User::where("id", $view_sub[0]->user_id)->get();
        if($submitter == null || $submitter->count() <= 0)
            return Redirect::back()->withErrors(['submission' => 'Could not find the user who submitted this paper']);
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $submission = $view_sub[0];
        if($status ==2)
            return view('submissions.resend', compact('submission', 'has_profile'));
        else if ($status == 3)
            return view('submissions.reject', compact('submission', 'has_profile'));
        else
            abort(404);

    }
}
