<?php

namespace App\Models\Submissions;

use App\Models\Submissions\SubmissionFilesModel;
use App\User;
use Illuminate\Database\Eloquent\Model;

class SubmissionsModel extends Model
{
    //
    protected $table = "submissions";
    protected $fillable = [
        "user_id", "user_token", "submssion_token", "submission_type", "submission_title", "submission_status",
        "submission_abstract", "submission_keywords", "submission_manuscript", "submission_cover",
    ];

    public function subFiles()
    {
        return $this->hasMany(SubmissionFilesModel::class, 'submission_id', 'id');
    }
    public function subAuthors()
    {
        return $this->hasMany(SubmissionAuthorsModel::class, 'submission_id', 'id');
    }
    public function Submitter()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    public function submissionStatus($status = null)
    {
        if ($status == null)
            $status = $this->submission_status;
        if ($status === $this->status_pending) {
            return "Pending for review";
        } else if ($status === $this->status_under_review) {
            return "Under review";
        } else if ($status === $this->status_resent) {
            return "Resent";
        } else if ($status === $this->status_reject) {
            return "Rejected";
        } else if ($status === $this->status_published) {
            return "Published";
        } else {
            return "Unknown status";
        }
    }
    public function UpdateStatusTracker($status)
    {
        $TrackerModel = new SubmissionChangesTrackerModel();
        return $TrackerModel->UpdateStatus($this->submission_status, $status, $this->id);
    }

    public function SubmissionChanges()
    {
        return $this->hasMany(SubmissionChangesTrackerModel::class, 'submission_id', 'id')->latest();
    }
    public function publishInformation()
    {
        return $this->hasMany(SubmissionChangesTrackerModel::class, 'submission_id', 'id')->where('target_status', 4);
    }


    public $status_pending = 0;
    public $status_under_review = 1;
    public $status_resent = 2;
    public $status_reject = 3;
    public $status_published = 4;
}
