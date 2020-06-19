<?php

namespace App\models\submissions;

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

    public function UpdateStatus($source, $target, $submission,$comment=null,$file=null)
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

    
}
