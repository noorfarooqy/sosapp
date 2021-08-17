<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateAppSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            $table->string('app_name')->default(env('APP_NAME'));
            $table->string('app_favicon')->default('/assets/images/favicon_dark.png');
            $table->string('app_logo')->default('/assets/images/logo_400x140_ambient_tansparent.png');
            $table->string('app_slogan')->default('Somali Studies Center');
            $table->boolean('app_maintain')->default(false);
            $table->boolean('app_registration')->default(true);
            $table->boolean('app_login')->default(true);
            $table->boolean('app_lock')->default(false);
            $table->string('app_key')->default(env('APP_KEY', base64_encode(Str::random(16))));
            $table->string('default_language')->default('en');
            $table->string('social_fb_link')->nullable();
            $table->string('social_tl_link')->nullable();
            $table->string('social_insta_link')->nullable();
            $table->string('social_yt_link')->nullable();
            $table->string('banner_image')->default('/assets/img/BANNER.jpg');
            $table->string('banner_small_title')->default('Think Big & Get Rewards');
            $table->string('banner_big_title')->default('Somali Studies Centre');
            $table->string('call_action_title')->default('Join Highly Qualified Somali Researchers');
            $table->string('call_action_left_title')->default('Access to thousands');
            $table->string('call_action_left_subtitle')->default('Access to thousands');
            $table->string('call_action_left_background')->default('/assets/img/home/top-info-box-1.png');
            $table->string('call_action_middle_title')->default('Unlimited');
            $table->string('call_action_middle_subtitle')->default('Article submission');
            $table->string('call_action_middle_background')->default('/assets/img/home/top-info-box-2.png');
            $table->string('call_action_middle_url')->default(env('APP_URL'));
            $table->string('call_action_right_title')->default('Forum');
            $table->string('call_action_right_subtitle')->default('Discussion');
            $table->string('call_action_right_background')->default('/assets/img/home/top-info-box-3.png');
            $table->string('call_action_right_url')->default(env('APP_URL'));
            $table->string('footer_background')->default('/assets/img/footerbg.jpg');
            $table->string('footer_call_number')->default('+254706046356');
            $table->string('footer_available_support_text')->default('24/7 support');
            $table->string('footer_email')->default(env('APP_SUPPORT_MAIL', 'info@soscentre.org'));
            $table->string('footer_schedule_time')->default('8:00AM - 4:000PM');
            $table->string('contact_page_title')->default('We listen and we improve');
            $table->string('contact_page_subtitle')->default('Contact us');
            $table->string('contact_page_background')->default('Contact us');
            $table->string('contact_page_email')->default(env('APP_SUPPORT_MAIL', 'info@soscentre.org'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_settings');
    }
}
