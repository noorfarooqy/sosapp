<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', 'profile\userProfileController@getProfileIndexPage')->name('profileIndexPage');
        Route::get('/details', 'profile\userProfileController@getProfileDetailsPage')->name('profileDetailsPage');

        Route::prefix('submission')->group(function () {
            Route::get('/new', 'submission\submissionController@newSubmissionPage')->name('newSubmissionPage')->middleware('verified');
            Route::get('/view/{id}', 'submission\submissionController@viewUserSubmission')->name('viewUserSubmission')->middleware('verified');
            Route::get('/pending', 'submission\submissionController@openPendingSubmissions')->name('openPendingSubmissions')->middleware('verified');
        });
    });
});

Route::get('/', 'home\guestRequestController@getHomePage')->name('homePage');
Route::get('/aboutus', 'home\guestRequestController@getAboutUsPage')->name('aboutUsPage');
// Route::get('/home', 'HomeController@index')->name('home');
