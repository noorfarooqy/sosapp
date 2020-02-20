<?php

namespace App\models\submissions;

use Illuminate\Database\Eloquent\Model;

class submissionFilesModel extends Model
{
    //
    protected $table = "submission_files";
    protected $fillable = [
        "submission_id", "submission_token", "submission_file",
        "submission_file_index","submission_file_type"
    ];

    
}
