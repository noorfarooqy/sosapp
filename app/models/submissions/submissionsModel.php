<?php

namespace App\models\submissions;

use Illuminate\Database\Eloquent\Model;
use App\models\submissions\submissionFilesModel;
class submissionsModel extends Model
{
    //
    protected $table = "submissions";
    protected $fillable = [
        "user_id", "user_token", "submssion_token", "submission_type", "submission_title", "submission_status",
        "submission_abstract", "submission_keywords", "submission_manuscript", "submission_cover"
    ];

    public function subFiles()
    {
        return $this->hasMany(submissionFilesModel::class, 'submission_id', 'id');
    }
    public function subAuthors()
    {
        return $this->hasMany(submissionAuthorsModel::class, 'submission_id', 'id');
    }
    public function submissionStatus()
    {
        if($this->submission_status === 0)
            return "Pending for review";
        else if($this->submission_status === 1)
            return "Under review";
        else if($this->submission_status === 2)
            return "Resent";
        else if($this->submission_status === 3)
            return "Rejected";
        else if($this->submission_status === 4)
            return "Published";
        else 
            return "Unknown status";
    }

    
}
