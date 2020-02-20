<?php

namespace App\models\submissions;

use Illuminate\Database\Eloquent\Model;

class submissionsModel extends Model
{
    //
    protected $table = "submissions";
    protected $fillable = [
        "user_id", "user_token", "submssion_token", "submission_type", "submission_title", "submission_status",
        "submission_abstract", "submission_keywords", "submission_manuscript", "submission_cover"
    ];

    
}
