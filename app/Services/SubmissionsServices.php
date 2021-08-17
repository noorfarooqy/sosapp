<?php
namespace App\Services;

use App\Models\Submissions\SubmissionChangesTrackerModel;
use App\Models\Submissions\SubmissionsModel;
use Illuminate\Support\Facades\Auth;

class SubmissionsServices extends DefaultService
{
    public function __construct()
    {
        $this->Model = new SubmissionsModel();
    }

    public function getSubmissionChangeById($request, $change_id)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();

        $change = SubmissionChangesTrackerModel::with('Submission')->find($change_id);
        if(!$change || !$change->Submission){
            $message = $this->setError("Submission or its changes not found");
            return $is_json ? $this->_404Response($message) : false;
        }
        $user = $request->user();
        if(!$user->IsAdmin() && $user->id != $change->Submission->user_id){
            $this->setError($message = "Submission not found in your list");
            return $is_json ? $this->_404Response($message) : false;
        }
        return $is_json ? $this->Parse(false, 'success', $change) : $change;
    }
}
