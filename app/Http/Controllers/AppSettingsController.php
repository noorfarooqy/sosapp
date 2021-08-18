<?php

namespace App\Http\Controllers;

use App\Services\AppSettingsServices;
use Illuminate\Http\Request;

class AppSettingsController extends Controller
{
    //
    public function __construct()
    {
        $this->Services = new AppSettingsServices();
    }

    public function viewSettingsPage(Request $request)
    {
        $settings = $this->Services->getAppSettings($request);
        return view('admin.settings.forms_view', compact('settings'));
    }
    public function uploadAppLogo(Request $request)
    {
        $logo = $this->Services->uploadAppLogo($request);
        return $logo;
    }
}
