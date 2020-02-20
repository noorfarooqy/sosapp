<?php

namespace App\models\submissions;

use Illuminate\Database\Eloquent\Model;

class submissionAuthorsModel extends Model
{
    //
    protected $table = "submission_authors";
    protected $fillable = [
        "submission_id", "submission_token", "author_firstname",
        "author_secondname", "author_email", "author_institute",
        "author_location", "author_gender"
    ];
}
