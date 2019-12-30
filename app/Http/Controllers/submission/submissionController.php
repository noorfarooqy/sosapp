<?php

namespace App\Http\Controllers\submission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;
class submissionController extends Controller
{
    //

    public function __construct()
    {
        
    }
    public function newSubmissionPage()
    {
        $user = Auth::user();
        $user_profile = $user->profileData;
        
        $has_profile = $user_profile !== null &&  $user_profile->count() ===1;
        return view('submissions.new_submission', compact('has_profile'));
    }
}
