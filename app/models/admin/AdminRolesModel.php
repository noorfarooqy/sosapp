<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Model;

class AdminRolesModel extends Model
{
    //
    protected $table = "admin_roles";

    protected $fillable = [
        "perm_name",
        "perm_submission",
        "perm_news",
        "perm_issues"
    ];
    
}
