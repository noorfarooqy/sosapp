<?php
namespace App\Services;

use App\Models\AppSettingsModel;
use Illuminate\Support\Facades\Cache;

class CacheServices
{
    public static $_1hr = 60*60;

    public static function getAppSettings($reset=false)
    {
        if($reset){
            Cache::forget('app_settings');
            return Cache::remember('app_settings', CacheServices::$_1hr, function(){
                return AppSettingsModel::get()->first();
            });
        }
        else{
            return Cache::remember('app_settings', CacheServices::$_1hr, function(){
                return AppSettingsModel::get()->first();
            });
        }
    }
}
