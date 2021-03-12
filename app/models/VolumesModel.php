<?php

namespace App\models;

use App\models\submissions\submissionsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolumesModel extends Model
{
    use HasFactory;
    protected $table = "volumes";
    protected $fillable = [
        "volume_submission_id",
        "volume_submission_token",
        "volume_year",
        "volume_month"
    ];

    public $error_message = null;
    public function updateOrCreateVolume($data){
        try {
            $volume = $this->updateOrCreate([
                ["id" , $data["volume_id"] ]
            ], $data);
            return $volume;
        } catch (\Throwable $th) {
            $this->error_message = $th->getMessage();
            return false;
        }
    }
    public function Submissions(){
        return $this->belongsTo(submissionsModel::class, 'volume_submission_id');
    }

}
