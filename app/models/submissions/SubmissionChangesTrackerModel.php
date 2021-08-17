<?php

namespace App\Models\Submissions;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class SubmissionChangesTrackerModel extends Model
{
    //
    protected $table = "submission_changes_tracker";

    protected $fillable = [
        "submission_id",
        "source_status",
        "target_status",
        "target_file",
        "comment",
        "changed_by"
    ];

    public function UpdateStatus($source, $target, $submission, $comment = null, $file = null)
    {
        return $this->create([
            "submission_id" => $submission,
            "source_status" => $source,
            "target_status" => $target,
            "target_file" => $file,
            "comment" => $comment,
            "changed_by" => Auth::user()->id,

        ]);
    }
    public function Submission()
    {
        return $this->belongsTo(SubmissionsModel::class,'submission_id');
    }
    public function Moderator()
    {
        return $this->belongsTo(User::class,'changed_by');
    }
}
