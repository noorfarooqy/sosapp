<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class guestRequestController extends Controller
{
    //

    public function getAboutUsPage()
    {
        return view('homepage.aboutus');
    }

    public function getHomePage()
    {
        return view('homepage.index');
    }
}
