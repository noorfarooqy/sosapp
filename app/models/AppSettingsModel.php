<?php

namespace App\Models;

use App\Traits\ErrorParser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppSettingsModel extends Model
{
    use HasFactory, ErrorParser;
    protected $table = "app_settings";
    protected $fillable = [
        "app_name",
        "app_favicon",
        "app_logo",
        "app_slogan",
        "app_maintain",
        "app_registration",
        "app_login",
        "app_lock",
        "app_key",
        "social_fb_link",
        "social_tl_link",
        "social_insta_link",
        "social_yt_link",
        "banner_image",
        "banner_small_title",
        "banner_big_title",
        "default_language",
        "call_action_title",
        "call_action_left_title",
        "call_action_left_subtitle",
        "call_action_left_background",
        "call_action_middle_title",
        "call_action_middle_subtitle",
        "call_action_middle_background",
        "call_action_middle_url",
        "call_action_right_title",
        "call_action_right_subtitle",
        "call_action_right_background",
        "call_action_right_url",
        "footer_background",
        "footer_call_number",
        "footer_available_support_text",
        "footer_email",
        "footer_schedule_time",
        "contact_page_title",
        "contact_page_subtitle",
        "contact_page_background",
        "contact_page_email"
    ];

    public function updateAppSettings($data, $setting_type=1)
    {
        try {
            $settings = $this->find(1);
            if(is_null($settings)){
                $this->create($data);
            }
            else{
                switch ($setting_type) {
                    case 1:
                        $this->updateAppBasicSettings($settings, $data);
                        break;
                    case 2:
                        $this->updateAppSocialSettings($settings, $data);
                        break;
                    
                    case 3:
                        $this->updateAppSocialSettings($settings, $data);
                        break;
                    case 4:
                        $this->updateAppCallToActionSettings($settings, $data);
                        break;
                    case 5:
                        $this->updateAppFooterSettings($settings, $data);
                        break;
                    case 6:
                        $this->updateAppContactSettings($settings, $data);
                        break;
                    default:
                        # code...
                        break;
                }
            }
        } catch (\Throwable $th) {
            $this->setError(env('APP_DEBUG') ? $th->getMessage() : $this->getError(" updating app basic settings"));
        }
    }
    public function updateAppBasicSettings($settings, $data)
    {
        
        $settings->app_name = $data["app_name"];
        $settings->app_favicon = $data["app_favicon"];
        $settings->app_logo = $data["app_logo"];
        $settings->app_slogan = $data["app_slogan"];
        $settings->app_maintain = $data["app_maintain"];
        $settings->app_registration = $data["app_registration"];
        $settings->app_login = $data["app_login"];
        $settings->app_lock = $data["app_lock"];
        $settings->app_key = $data["app_key"];
        $settings->default_language = $data["default_language"];
        $settings->save();   
        return true;
    }
    public function updateAppSocialSettings($settings,$data)
    {
        $settings->social_fb_link = $data["social_fb_link"];
        $settings->social_tl_link = $data["social_tl_link"];
        $settings->social_insta_link = $data["social_insta_link"];
        $settings->social_yt_link = $data["social_yt_link"];
        $settings->save();
    }
    public function updateAppBannerSettings($settings,$data)
    {
        $settings->banner_image = $data["banner_image"];
        $settings->banner_small_title = $data["banner_small_title"];
        $settings->banner_big_title = $data["banner_big_title"];
        $settings->save();
    }
    public function updateAppCallToActionSettings($settings,$data)
    {
        $settings->call_action_title = $data["call_action_title"];
        $settings->call_action_left_title = $data["call_action_left_title"];
        $settings->call_action_left_subtitle = $data["call_action_left_subtitle"];
        $settings->call_action_left_background = $data["call_action_left_background"];
        $settings->call_action_middle_title = $data["call_action_middle_title"];
        $settings->call_action_middle_subtitle = $data["call_action_middle_subtitle"];
        $settings->call_action_middle_url = $data["call_action_middle_url"];
        $settings->call_action_right_title = $data["call_action_right_title"];
        $settings->call_action_right_subtitle = $data["call_action_right_subtitle"];
        $settings->call_action_right_background = $data["call_action_right_background"];
        $settings->call_action_right_url = $data["call_action_right_url"];
        $settings->save();
    }
    public function updateAppFooterSettings($settings,$data)
    {
        $settings->footer_background = $data["footer_background"];
        $settings->footer_call_number = $data["footer_call_number"];
        $settings->footer_available_support_text = $data["footer_available_support_text"];
        $settings->footer_email = $data["footer_email"];
        $settings->footer_schedule_time = $data["footer_schedule_time"];
        $settings->save();
    }
    public function updateAppContactSettings($settings,$data)
    {
        $settings->contact_page_title = $data["contact_page_title"];
        $settings->contact_page_subtitle = $data["contact_page_subtitle"];
        $settings->contact_page_background = $data["contact_page_background"];
        $settings->contact_page_email = $data["contact_page_email"];
        $settings->save();
    }
}
