<?php

namespace App\Http\Controllers\profile;

use App\CustomClass\CustomValidator;
use App\CustomClass\FileManager;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use App\models\profile\userProfileModel;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class userProfileController extends Controller
{
    //
    protected $Status;
    protected $CustomValidator;
    protected $FileManager;
    public function __construct()
    {
        $this->Status = new Status();
        $this->CustomValidator = new CustomValidator();
        $this->FileManager = new FileManager();
    }
    public function getProfileIndexPage()
    {
        return view('profile.index');
    }
    public function getProfileDetailsPage(Request $request)
    {
        $profile = $request->user();
        $profile_data = $profile->profileData;
        if ($profile_data !== null && $profile_data->count() >= 1) {
            return view('profile.profile.details', compact('profile_data'));
        }
        return view('profile.profile.details');
    }

    public function updateUserProfile(Request $request)
    {
        $profile = $request->user();
        if ($profile === null || $profile === []) {
            $this->Status->setError(["The user profile authentication is not valid"]);
            return $this->Status->getError();
        }

        $rules = [
            "user_title" => "required|min:2|max:45",
            "user_profession" => "required|min:2|max:45",
            "user_country" => "required|min:3|max:45",
            "user_city" => "required|min:3|max:45",
            "user_institute" => "required|min:3|max:250",
            "user_institute_location" => "required|min:3|max:45",
            "user_gender" => "required|integer|in:0,1",
        ];
        $is_valid = Validator::make($request->all(), $rules, []);
        $isNotValidRequest = $this->CustomValidator->isNotValidRequest($is_valid);
        if ($isNotValidRequest) {
            return $isNotValidRequest;
        }

        $profile_data = $profile->profileData;
        if ($profile_data === null || $profile_data->count() <= 0) {
            $token = hash('sha256', time() . Str::random(80));
            userProfileModel::create([
                "user_id" => $profile->id,
                "user_token" => $token,
                "user_title" => $request->user_title,
                "living_city" => $request->user_city,
                "living_country" => $request->user_country,
                "institute" => $request->user_institute,
                "institute_country" => $request->user_institute_location,
                "profession" => $request->user_profession,
                "gender" => $request->user_gender,
                "profile_picture" => "/profile_assets/img/user_icon.png",
            ]);
        } else {
            $profile_data->update([
                "user_title" => $request->user_title,
                "living_city" => $request->user_city,
                "living_country" => $request->user_country,
                "institute" => $request->user_institute,
                "institute_country" => $request->user_institute_location,
                "profession" => $request->user_profession,
            ]);
        }

        $this->Status->setSuccess(["we are so good "]);
        return $this->Status->getSuccess();

    }
    public function getProfileDetailsJson(Request $request)
    {
        $profile = $request->user();

        $profile_data = $profile->profileData;
        if ($profile_data == null || $profile_data->count() <= 0) {
            $this->Status->setError(["The profile is not set "]);
            return $this->Status->getError();
        }

        $this->Status->setSuccess([
            "Profile" => [
                "first_name" => $profile->name,
                "second_name" => "",
                "email" => $profile->email,
                "location" => $profile_data->living_country,
                "institute" => $profile_data->institute,
                "gender" => $profile_data->gender,
            ],
        ]);
        return $this->Status->getSuccess();
    }
}
