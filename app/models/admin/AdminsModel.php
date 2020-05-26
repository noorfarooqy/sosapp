<?php

namespace App\models\admin;

use Illuminate\Database\Eloquent\Model;

class AdminsModel extends Model
{
    //
    protected $table = "admins";

    protected $fillable = [
        "admin_id",	
        "admin_role",	
        "is_active",	
        "created_by",
    ];
    public function AdminRole()
    {
        return $this->hasOne(AdminRolesModel::class, 'id', 'admin_role');
    }
}
