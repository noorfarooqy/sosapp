<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\models\submissions\SubmissionChangesTrackerModel;
use App\models\submissions\submissionsModel;
use App\Notifications\PublishSubmissionNotification;
use App\Notifications\RejectSubmissionNotification;
use App\Notifications\submission\SubmissionUnderReviewNotification;
use App\Notifications\submission\ResendSubmissionNotification;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    //
    protected $error_message;
    public function __construct()
    {
        $this->error_message = null;
    }
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
        if ($submitter == null || $submitter->count() <= 0)
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
        return $this->ResendRejectValidation($request, $sub_id, 3);
    }

    protected function ResendRejectValidation($request, $sub_id, $status = 2)
    {
        $profile = $this->CheckSubmissionAndAdmin($request, $sub_id);
        // return $user_profile;
        abort_if($profile == null, 404);
        if (!$profile)
            return Redirect::back()->withErrors(['submission' => $this->error_message]);
        else {
            $user_profile = $profile[0];
            $view_sub = $profile[1];
        }

        if ($user_profile == null) {
            return Redirect::back()->withErrors(['submission'  => 'Could not find data on the profile']);
        } else if ($view_sub == null) {
            return Redirect::back()->withErrors(['submission'  => 'Could not find data on the submission']);
        }
        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $submission = $view_sub[0];
        if ($status == 2)
            return view('submissions.resend', compact('submission', 'has_profile'));
        else if ($status == 3)
            return view('submissions.reject', compact('submission', 'has_profile'));
        else
            abort(404);
    }

    public function PublishSubmissionPage(Request $request, $sub_id)
    {
        $profile = $this->CheckSubmissionAndAdmin($request, $sub_id);
        abort_if($profile == null, 404);
        if ($profile == false)
            return Redirect::back()->withErrors(['submission' => $this->error_message]);
        else {
            $user_profile = $profile[0];
            $submission = $profile[1][0];
            $submitter = $profile[2][0];
        }
        // $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.publish', compact('submission'));
    }

    public function CheckSubmissionAndAdmin($request, $sub_id)
    {
        $user = $request->user();
        $admin = $user->AdminInfo;
        abort_if(($admin->count() <= 0 || $admin->AdminRole == null || $admin->AdminRole->perm_submission < 30), 403);
        $view_sub = submissionsModel::where([
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            // abort(404);
            return null;
        }

        $submitter = User::where("id", $view_sub[0]->user_id)->get();
        if ($submitter == null || $submitter->count() <= 0) {
            $this->error_message = 'Could not find the user who submitted this paper';
            return false;
        }
        // return Redirect::back()->withErrors(['submission' => 'Could not find the user who submitted this paper']);
        $user_profile = $user->profileData;
        return [$user_profile, $view_sub, $submitter];
    }

    public function UpdateSubmissionStatus(Request $request, $sub_id, $type)
    {
        $profile = $this->CheckSubmissionAndAdmin($request, $sub_id);
        abort_if($profile == null, 404);
        if ($profile == false)
            return Redirect::back()->withErrors(['submission' => $this->error_message]);
        else {
            $user_profile = $profile[0];
            $submission = $profile[1][0];
            $submitter = $profile[2][0];
        }
        $status = $submission->submission_status;
        $target_status = null;
        $rules = [
            "comment" => "required|string|max:1200|min:3",
            "updateFile" => "required|file|mimes:doc,docx"
        ];
        switch ($type) {
            case 2:
                if ($status == $submission->status_pendin || $status == $submission->status_under_review) {
                    // 
                    $target_status = $type; //resend
                    $Notifier = new ResendSubmissionNotification($submitter, $submission);
                } else
                    return Redirect::back()->withErrors(['submission' => 'The submission status cannot be resent']);
                break;
            case 3:
                if ($status == $submission->status_under_review || $status == $submission->status_pending) {
                    $target_status = $type; //reject

                    $Notifier = new RejectSubmissionNotification($submitter, $submission);
                } else
                    return Redirect::back()->withErrors(['submission' => 'The submission status cannot be rejected']);
                break;
            case 4:
                if ($status == $submission->status_under_review) {
                    $target_status = $type; //publish 
                    $Notifier = null;
                    $rules["updateFile"] = "required|file|mimes:pdf";
                } else
                    return Redirect::back()->withErrors(['submission' => 'The submission status cannot be published before reviewing']);
                break;
            default:
                return Redirect::back()->withErrors(['submission' => 'Unknown submission update status']);
        }




        $data = $request->validate($rules);
        $path = "uploads/submission/" . $submission->submission_token . '/files/';
        try {
            $upload_url = $request->file('updateFile')->store($path, 'public');
        } catch (Exception $th) {
            return Redirect::back()->withErrors(['updateFile', $th->getMessage()]);
        }

        $data["updateFile"] = "/storage/$upload_url";
        if ($type == 4)
            $Notifier = new PublishSubmissionNotification($submitter, $submission, $data["updateFile"]);

        $SubmissionTracker = new SubmissionChangesTrackerModel();
        $new_status = $SubmissionTracker->UpdateStatus(
            $status,
            $target_status,
            $submission->id,
            $request->comment,
            $data["updateFile"]
        );

        if (!$new_status)
            return Redirect::back()->withErrors(['submission' => $SubmissionTracker->getError()]);
        $submission->update(['submission_status' => $target_status]);
        try {
            $submitter->notify($Notifier);
        } catch (Exception $th) {
            $new_status->delete();
            $submission->update(['submission_status' => $status]);
            return Redirect::back()->withErrors([
                'submission' => "Could not send the notification to the users . " . $th->getMessage()
            ]);
        }
        return redirect()->route('view_paper_submission', ['id' => $sub_id])->with('success', 'Successfully resent submission');
    }
}
