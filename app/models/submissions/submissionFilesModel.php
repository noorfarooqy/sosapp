<?php

namespace App\Models\Submissions;
use App\Models\Submissions\SubmissionsModel;
use Illuminate\Database\Eloquent\Model;

class SubmissionFilesModel extends Model
{
    //
    protected $table = "submission_files";
    protected $fillable = [
        "submission_id", "submission_token", "submission_file",
        "submission_file_index","submission_file_type"
    ];

    public function submission()
    {
        return $this->belongsTo(SubmissionsModel::class, 'id', 'submission_id');
    }

    
}
