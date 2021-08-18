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

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AppSettingsController;
use App\Http\Controllers\home\guestRequestController;
use App\Http\Controllers\profile\userProfileController;
use App\Http\Controllers\submission\submissionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

Route::middleware(['auth'])->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [userProfileController::class, 'getProfileIndexPage'])->name('profileIndexPage');
        Route::get('/details', [userProfileController::class,'getProfileDetailsPage'])->name('profileDetailsPage');

        Route::prefix('submission')->group(function () {
            Route::middleware('verified')->group(function () {
                Route::get('/new', [submissionController::class, 'newSubmissionPage'])->name('newSubmissionPage');
                Route::get('/changes/{id}', [submissionController::class, 'viewUserSubmissionChanges'])->name('viewUserSubmission');
                Route::get('/view/{id}', [submissionController::class, 'viewUserSubmission'])->name('viewUserSubmission');
                Route::post('/resubmit/{id}', [submissionController::class, 'ResubmitUserSubmission'])->name('viewUserSubmission');
                Route::get('/edit/manuscript/{id}', [submissionController::class, 'editManuscript'])->name('update_manuscript');
                Route::post('/edit/manuscript/{id}', [submissionController::class, 'doEditManuscript'])->name('doupdate_manuscript');
                Route::get('/edit/authors/{id}', [submissionController::class, 'editManuscriptAuthors'])->name('update_authors');
                Route::post('/edit/authors/{id}', [submissionController::class, 'doEditManuscriptAuthors'])->name('update_authors');
                Route::get('/edit/figures/{id}', [submissionController::class, 'editManuscriptFiles'])->name('update_files');
                Route::post('/edit/figures/{id}', [submissionController::class, 'doEditManuscriptFiles'])->name('update_files');
                Route::get('/re/author/{sub_id}/{auth_id}', [submissionController::class, 'remSubmissionAuthor'])->name('rem_sub_author');
                Route::get('/re/figure/{sub_id}/{auth_id}', [submissionController::class, 'remSubmissionFigure'])->name('rem_sub_figure');
                Route::get('/accepted', [submissionController::class,'openAcceptedSubmissions'])->name('openAcceptedSubmissions');
                Route::get('/pending', [submissionController::class, 'openPendingSubmissions'])->name('openPendingSubmissions');
                Route::get('/resent', [submissionController::class, 'openResentSubmissions'])->name('openPendingSubmissions');
                Route::get('/rejected', [submissionController::class, 'openRejectedSubmissions'])->name('openPendingSubmissions');
            });
        });
    });

    Route::middleware(['admin'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('submission')->group(function () {
                Route::get('/changes/{id}', [submissionController::class, 'viewUserSubmissionChanges'])->name('viewUserSubmission');
                Route::get('/view/{id}', [AdminController::class,'viewUserPaper'])->name('view_paper_submission');
                Route::get('/accepted', [AdminController::class, 'OpenAcceptedPapers']);
                Route::get('/rejected', [AdminController::class, 'openRejectedPapers']);
                Route::get('/resent', [AdminController::class, 'openResentPapers']);
                Route::get('/pending', [AdminController::class, 'openPendingPapers']);
                Route::prefix('/status')->group(function () {
                    Route::post('/review/{sub_id}', [AdminController::class, 'SetStatusReview']);
                    Route::get('/resend/{sub_id}', [AdminController::class, 'ResendSubmissionPage']);
                    Route::post('/update/{sub_id}/{type}', [AdminController::class, 'UpdateSubmissionStatus']);
                    Route::get('/reject/{sub_id}', [AdminController::class, 'RejectSubmissionPage']);
                    Route::get('/publish/{sub_id}', [AdminController::class, 'PublishSubmissionPage']);
                });
            });
            Route::prefix('/feedback')->group(function(){
                Route::get('/', [AdminController::class, 'ViewFeedback'])->name('feedback.all');
                Route::get('/read',[AdminController::class, 'ViewReadStatusFeedback'])->name('feedback.status');
            });
            Route::get('/settings', [AppSettingsController::class,'viewSettingsPage'])->name('settings.view');
            Route::post('/settings/file', [AppSettingsController::class,'uploadAppLogo'])->name('settings.view');
        });
    });
});

Route::get('/', [guestRequestController::class, 'getHomePage'])->name('homePage');
Route::get('/submission/{sub_id}/{sub_token}', [guestRequestController::class, 'viewPublication']);
Route::get('/aboutus', [guestRequestController::class, 'getAboutUsPage'])->name('aboutUsPage');
Route::get('/archive', [guestRequestController::class, 'OpenArchivePage'])->name('archivePage');
Route::get('/contactus', [guestRequestController::class, 'ViewContactUsPage'])->name('viewContactUsPage');
// Route::get('/home', 'HomeController@index')->name('home');
