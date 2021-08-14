<?php

namespace App\Models\Profile;

use Illuminate\Database\Eloquent\Model;

class userProfileModel extends Model
{
    //
    protected $table = "person_info";

    protected $fillable = [
        "user_id", "user_token", "user_title", "living_city",
        "living_country", "institute", "institute_country", "profession", 
        "gender", "profile_picture"
    ];
}
