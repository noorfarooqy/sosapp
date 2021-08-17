<?php

namespace Database\Seeders;

use App\Models\AppSettingsModel;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $favicon = public_path("/admin/assets/images/logo-icon.png");
        $logo = public_path("/admin/assets/images/logo_400x140_transaprent.png");
        $data = [
            "app_name" => env("APP_NAME"),
            "app_favicon" => "/admin/assets/images/logo-icon.png",
            "app_logo" => "/admin/assets/images/logo_400x140_transaprent.png",
            "app_slogan" => "Top peer to peer journal"
        ];
        
        $settingsmodel = new AppSettingsModel();
        $basic = $settingsmodel->updateAppSettings($data);
        if($basic){
            echo "[+] Successfully seeded settings".PHP_EOL;
        }
        else
            echo "[-] Something wrong in seeding settings ".$settingsmodel->getMessage().PHP_EOL;
    }
}
