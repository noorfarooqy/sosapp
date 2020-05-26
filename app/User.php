<?php

namespace App;

use App\models\admin\AdminsModel;
use App\models\submissions\submissionsModel;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profileData()
    {
        return $this->hasOne('App\models\profile\userProfileModel', 'user_id', 'id');
    }
    public function allSubmissions()
    {
        return $this->hasMany(submissionsModel::class, 'user_id', 'id');
    }
    public function getPendingSubmissions()
    {
        return $this->whereHas('allSubmissions', function (Builder $query) {
            $query->where('submission_status', '=', 0);
        });
    }

    public function AdminInfo()
    {
        if(!$this->HasAnyAdmin())
            $this->AddNewAdmin($this->id, 0, true, $this->id);
        return $this->hasOne(AdminsModel::class, 'admin_id', 'id');
    }
    public function IsAdmin()
    {
        return $this->hasOne(AdminsModel::class, 'admin_id', 'id')->count() > 0;
    }

    protected function HasAnyAdmin()
    {
        return AdminsModel::get()->count() >= 1;
    }

    public function AddNewAdmin($admin, $role=0, $active=true,$creator)
    {
        return AdminsModel::create([
            "admin_id" => $admin,
            "admin_role" => $role,
            "is_active" => $active,
            "created_by" => $creator,
        ]);
    }
}
