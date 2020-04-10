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
            Route::middleware('verified')->group(function () {
                Route::get('/new', 'submission\submissionController@newSubmissionPage')->name('newSubmissionPage');
                Route::get('/view/{id}', 'submission\submissionController@viewUserSubmission')->name('viewUserSubmission');
                Route::post('/resubmit/{id}', 'submission\submissionController@ResubmitUserSubmission')->name('viewUserSubmission');
                Route::get('/edit/manuscript/{id}', 'submission\submissionController@editManuscript')->name('update_manuscript');
                Route::post('/edit/manuscript/{id}', 'submission\submissionController@doEditManuscript')->name('doupdate_manuscript');
                Route::get('/edit/authors/{id}', 'submission\submissionController@editManuscriptAuthors')->name('update_authors');
                Route::post('/edit/authors/{id}', 'submission\submissionController@doEditManuscriptAuthors')->name('update_authors');
                Route::get('/edit/figures/{id}', 'submission\submissionController@editManuscriptFiles')->name('update_files');
                Route::post('/edit/figures/{id}', 'submission\submissionController@doEditManuscriptFiles')->name('update_files');
                Route::get('/re/author/{sub_id}/{auth_id}', 'submission\submissionController@remSubmissionAuthor')->name('rem_sub_author');
                Route::get('/re/figure/{sub_id}/{auth_id}', 'submission\submissionController@remSubmissionFigure')->name('rem_sub_figure');
                Route::get('/accepted', 'submission\submissionController@openAcceptedSubmissions')->name('openAcceptedSubmissions');
                Route::get('/pending', 'submission\submissionController@openPendingSubmissions')->name('openPendingSubmissions');
                Route::get('/resent', 'submission\submissionController@openResentSubmissions')->name('openPendingSubmissions');
                Route::get('/rejected', 'submission\submissionController@openRejectedSubmissions')->name('openPendingSubmissions');
            });

        });
    });
});

Route::get('/', 'home\guestRequestController@getHomePage')->name('homePage');
Route::get('/aboutus', 'home\guestRequestController@getAboutUsPage')->name('aboutUsPage');
// Route::get('/home', 'HomeController@index')->name('home');
