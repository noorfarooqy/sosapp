<?php

namespace App\models\submissions;
use App\models\submissions\submissionsModel;
use Illuminate\Database\Eloquent\Model;

class submissionFilesModel extends Model
{
    //
    protected $table = "submission_files";
    protected $fillable = [
        "submission_id", "submission_token", "submission_file",
        "submission_file_index","submission_file_type"
    ];

    public function submission()
    {
        return $this->belongsTo(submissionsModel::class, 'id', 'submission_id');
    }

    
}
