<?php

namespace App\models\submissions;

use App\models\submissions\submissionFilesModel;
use Illuminate\Database\Eloquent\Model;

class submissionsModel extends Model
{
    //
    protected $table = "submissions";
    protected $fillable = [
        "user_id", "user_token", "submssion_token", "submission_type", "submission_title", "submission_status",
        "submission_abstract", "submission_keywords", "submission_manuscript", "submission_cover",
    ];

    public function subFiles()
    {
        return $this->hasMany(submissionFilesModel::class, 'submission_id', 'id');
    }
    public function subAuthors()
    {
        return $this->hasMany(submissionAuthorsModel::class, 'submission_id', 'id');
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
        return $this->hasMany(SubmissionChangesTrackerModel::class, 'submission_id', 'id');
    }

    public $status_pending = 0;
    public $status_under_review = 1;
    public $status_resent = 2;
    public $status_reject = 3;
    public $status_published = 4;
}
