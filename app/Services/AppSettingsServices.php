<?php
namespace App\Services;

use App\Models\AppSettingsModel;

class AppSettingsServices extends DefaultService
{
    public function __construct()
    {
        $this->Model = new AppSettingsModel();
    }
    public function updateBasicSettings($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();
        $this->rules = [
            "app_name" => "required|string|max:125",
            "app_favicon" => "required|image",
            "app_logo" => "nullable|image",
            "app_slogan" => "nullable|string|max:123",
            "app_maintain" => "nullable|in:0,1",
            "app_registration" => "nullable|0,1",
            "app_login" => "nullable|0,1",
            "app_lock" => "nullable|0,1",
            "app_key" => "nullable|string|max:123",
            "default_language" => "nullable|string|max:5"
        ];

        $this->CustomValidate();
        if($this->has_failed)
            return $is_json ? $this->_422Response($this->getMessage()) : false;
        $data = $this->ValidatedData();
        if($request->filled('app_favicon')){
            $path = "uploads/settings/";
            $image = $this->UploadPublicFile($request->app_favicon, $path);
            if(!$image){
                return $is_json ? $this->_422Response($this->getMessage()) : false;
            }
            $data["app_favicon"] = "/storage/$image";
        }if($request->filled('app_logo')){
            $path = "uploads/settings/";
            $image = $this->UploadPublicFile($request->app_logo, $path);
            if(!$image){
                return $is_json ? $this->_422Response($this->getMessage()) : false;
            }
            $data["app_logo"] = "/storage/$image";
        }
        $settings = $this->Model->updateAppSettings($data, 1);
        if($settings)
            return $is_json ? $this->Parse(false, 'success', $settings) : $settings;
        $this->setError($message = $this->Model->getMessage());
        return $is_json ? $this->_422Response($message) : false;
    }
    public function updateSocialSettings($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();
        $this->rules = [
            "social_fb_link" => "nullable|string|max:125",
            "social_tl_link" => "nullable|string|max:125",
            "social_insta_link" => "nullable|string|max:125",
            "social_yt_link" => "nullable|string|max:125",
        ];

        $this->CustomValidate();
        if($this->has_failed)
            return $is_json ? $this->_422Response($this->getMessage()) : false;
        $data = $this->ValidatedData();
        $settings = $this->Model->updateAppSettings($data, 2);
        if($settings)
            return $is_json ? $this->Parse(false, 'success', $settings) : $settings;
        $this->setError($message = $this->Model->getMessage());
        return $is_json ? $this->_422Response($message) : false;
    }
    public function updateBannerSettings($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();
        $this->rules = [
            "banner_image" => "nullable|string|max:125",
            "banner_small_title" => "nullable|string|max:125",
            "banner_big_title" => "nullable|string|max:125",
        ];

        $this->CustomValidate();
        if($this->has_failed)
            return $is_json ? $this->_422Response($this->getMessage()) : false;
        $data = $this->ValidatedData();
        $settings = $this->Model->updateAppSettings($data, 3);
        if($settings)
            return $is_json ? $this->Parse(false, 'success', $settings) : $settings;
        $this->setError($message = $this->Model->getMessage());
        return $is_json ? $this->_422Response($message) : false;
    }
    public function updateCallToActionSettings($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();
        $this->rules = [
            "call_action_title" => "required|string|max:55",
            "call_action_left_title" => "required|string|max:55",
            "call_action_left_subtitle" => "required|string|max:55",
            "call_action_left_background" => "nullable|image|max:5000",
            "call_action_middle_title" => "required|string|max:55",
            "call_action_middle_subtitle" => "required|string|max:55",
            "call_action_middle_background" => "nullable|image|max:5000",
            "call_action_middle_url" => "required|string|max:55",
            "call_action_right_title" => "required|string|max:55",
            "call_action_right_subtitle" => "required|string|max:55",
            "call_action_right_background" => "nullable|image|max:5000",
            "call_action_right_url" => "required|string|max:55",
        ];

        $this->CustomValidate();
        if($this->has_failed)
            return $is_json ? $this->_422Response($this->getMessage()) : false;
        $data = $this->ValidatedData();
        if($request->filled('call_action_left_background')){
            $path = "uploads/settings/";
            $image = $this->UploadPublicFile($request->call_action_left_background, $path);
            if(!$image){
                return $is_json ? $this->_422Response($this->getMessage()) : false;
            }
            $data["call_action_left_background"] = "/storage/$image";
        }if($request->filled('call_action_middle_background')){
            $path = "uploads/settings/";
            $image = $this->UploadPublicFile($request->call_action_middle_background, $path);
            if(!$image){
                return $is_json ? $this->_422Response($this->getMessage()) : false;
            }
            $data["call_action_middle_background"] = "/storage/$image";
        }if($request->filled('call_action_right_background')){
            $path = "uploads/settings/";
            $image = $this->UploadPublicFile($request->call_action_right_background, $path);
            if(!$image){
                return $is_json ? $this->_422Response($this->getMessage()) : false;
            }
            $data["call_action_right_background"] = "/storage/$image";
        }
        $settings = $this->Model->updateAppSettings($data, 4);
        if($settings)
            return $is_json ? $this->Parse(false, 'success', $settings) : $settings;
        $this->setError($message = $this->Model->getMessage());
        return $is_json ? $this->_422Response($message) : false;
    }

    public function updateFooterSettings($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();
        $this->rules = [
            "footer_background" => "nullable|image|max:5000",
            "footer_call_number" => "required|string|max:25",
            "footer_available_support_text" => "required|string|max:123",
            "footer_email" => "required|email|max:123",
            "footer_schedule_time" => "required|string|max:124",
        ];

        $this->CustomValidate();
        if($this->has_failed)
            return $is_json ? $this->_422Response($this->getMessage()) : false;
        $data = $this->ValidatedData();
        if($request->filled('footer_background')){
            $path = "uploads/settings/";
            $image = $this->UploadPublicFile($request->footer_background, $path);
            if(!$image){
                return $is_json ? $this->_422Response($this->getMessage()) : false;
            }
            $data["footer_background"] = "/storage/$image";
        }
        $settings = $this->Model->updateAppSettings($data, 5);
        if($settings)
            return $is_json ? $this->Parse(false, 'success', $settings) : $settings;
        $this->setError($message = $this->Model->getMessage());
        return $is_json ? $this->_422Response($message) : false;
    }
    public function updateContactSettings($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();
        $this->rules = [
            "contact_page_background" => "nullable|image|max:5000",
            "contact_page_subtitle" => "required|string|max:25",
            "contact_page_title" => "required|string|max:123",
            "contact_page_email" => "required|email|max:123",
        ];

        $this->CustomValidate();
        if($this->has_failed)
            return $is_json ? $this->_422Response($this->getMessage()) : false;
        $data = $this->ValidatedData();
        if($request->filled('contact_page_background')){
            $path = "uploads/settings/";
            $image = $this->UploadPublicFile($request->contact_page_background, $path);
            if(!$image){
                return $is_json ? $this->_422Response($this->getMessage()) : false;
            }
            $data["contact_page_background"] = "/storage/$image";
        }
        $settings = $this->Model->updateAppSettings($data, 6);
        if($settings)
            return $is_json ? $this->Parse(false, 'success', $settings) : $settings;
        $this->setError($message = $this->Model->getMessage());
        return $is_json ? $this->_422Response($message) : false;
    }
    public function uploadAppLogo($request)
    {
        $this->request = $request;

        if($request->type != "logo" && $request->type != "favicon"){
            return json_encode(["success" => false, "error" => "invalid parameter type", "errorcode" => 422]);
        }
        $this->rules = [
            "files" => "required|image|mimes:jpeg,png,jpeg"
        ];
        $this->CustomValidate();
        if($this->has_failed){
            return json_encode(["success" => false, "error" => $this->getMessage(), "errorcode" => 422]);
        }

        $data = $this->ValidatedData();

        $response =  $this->FancyUploadFile($data["files"], "upload/settings/");
        if($this->fancy_success && !is_null($this->fancy_filename)){
            $settings = $this->Model->get()->first();
            if($request->type == "logo")
                $settings->app_logo = "/storage/".$this->fancy_filename;
            else
                $settings->app_favicon = "/storage/".$this->fancy_filename;
            $settings->save();
            return $response;
        }
        return $response;
        

    }

    public function getAppSettings($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();

        $settings = CacheServices::getAppSettings();

        return $is_json ? $this->Parse(false, 'success', $settings) : $settings;
    }


}
