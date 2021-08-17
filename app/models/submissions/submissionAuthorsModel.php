<?php

namespace App\Models\Submissions;

use Illuminate\Database\Eloquent\Model;

class SubmissionAuthorsModel extends Model
{
    //
    protected $table = "submission_authors";
    protected $fillable = [
        "submission_id", "submission_token", "author_firstname",
        "author_secondname", "author_email", "author_institute",
        "author_location", "author_gender"
    ];
}
