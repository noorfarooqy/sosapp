<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function () {
    
    Route::post('/profile/update', 'profile\userProfileController@updateUserProfile')->name('updateUserProfile');
    Route::post('/profile/details', 'profile\userProfileController@getProfileDetailsJson')->name('profileDetails');

    Route::middleware('verified')->group(function(){
        Route::prefix('/submission')->group(function(){
            Route::post('manuscript', 'submission\submissionController@setManuscript');
            Route::post('authors', 'submission\submissionController@setManuscriptAuthors');
            Route::post('files', 'submission\submissionController@setManuscriptFiles');
        });
    });
});

// Route::middleware('auth:api')->post('/profile/update', function(Request $request) {
//     return $request->user();
// });