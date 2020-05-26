<?php

namespace App\Http\Controllers\submission;

use App\CustomClass\CustomValidator;
use App\CustomClass\FileManager;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use App\models\submissions\submissionAuthorsModel;
use App\models\submissions\submissionFilesModel;
use App\models\submissions\submissionsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use \Auth;

class submissionController extends Controller
{
    //
    protected $Status;
    protected $FileMananger;
    protected $CustomValidator;
    public function __construct()
    {
        $this->Status = new Status();
        $this->FileMananger = new FileManager();
        $this->CustomValidator = new CustomValidator();
        $this->submision_folder = Str::random(15) . "_" . time();
    }
    public function newSubmissionPage()
    {
        $user = Auth::user();
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;
        return view('submissions.new_submission', compact('has_profile'));
    }

    public function setManuscript(Request $request)
    {
        $is_valid_request = $this->isValidRequestForSubmission($request);
        if ($is_valid_request !== true) {
            return $is_valid_request;
        }

        $user = $request->user();

        $user_profile = $user->profileData;
        if ($user_profile === null || $user_profile->count() <= 0) {
            $this->Status->setError(["Your profile is not complete"]);
            return $this->Status->getError();
        }

        $uploaded_manuscript = $this->UploadManuscript($request->mansucript_file, $user_profile);
        if ($uploaded_manuscript === false) {
            return $this->FileMananger->getError();
        }
        $uploaded_cover = $this->UploadManuscript($request->mansucript_cover, $user_profile);
        if ($uploaded_cover === false) {
            return $this->FileMananger->getError();
        }

        $uploaded_figures = $this->setManuscriptFiles($request, $user_profile);
        if ($uploaded_figures === false) {
            return $this->FileMananger->getError();
        } else if (!is_array($uploaded_figures) || count($uploaded_figures) <= 0) {
            $this->Status->setError(["The uploaded figures are empty."]);
            return $this->Status->getError();
        }

        $is_valid_authors = $this->isValidAuthors($request);

        if ($is_valid_authors !== true) {
            return $is_valid_authors;
        }

        $submission_token = Str::random(32) . time();

        $submission = submissionsModel::create([
            "user_id" => $user->id,
            "user_token" => $user_profile->user_token,
            "submssion_token" => $submission_token,
            "submission_type" => $request->mansucript_type,
            "submission_title" => $request->manuscript_title,
            "submission_abstract" => $request->manuscript_abstract,
            "submission_keywords" => $request->mansucript_keywords,
            "submission_manuscript" => $uploaded_manuscript,
            "submission_cover" => $uploaded_cover,
        ]);

        foreach ($uploaded_figures as $key => $figure) {
            # code...
            $sub_files = submissionFilesModel::create([
                "submission_id" => $submission->id,
                "submission_token" => $submission_token,
                "submission_file" => $figure,
                "submission_file_index" => $key,
            ]);
        }
        $authors = $request->get('manuscript_authors');
        $saved_authors = [];
        foreach ($authors as $key => $author) {
            # code...
            $author = json_decode($author, true);
            $sub_authors = submissionAuthorsModel::create([
                "submission_id" => $submission->id,
                "submission_token" => $submission_token,
                "author_firstname" => $author['first_name'],
                "author_secondname" => $author['second_name'],
                "author_email" => $author['email'],
                "author_institute" => $author['institute'],
                "author_location" => $author['location'],
                "author_gender" => $author['gender'],
            ]);
            array_push($saved_authors, $author);
        }

        $this->Status->setSuccess(["submission" => $submission]);
        return $this->Status->getSuccess();

    }
    public function setManuscriptFiles(Request $request, $user_profile)
    {
        // $is_valid = $this->isValidFiles($request);
        $path = "uploads/" . $user_profile->user_token . "/submissions/$this->submision_folder/";
        $this->FileMananger->setExtension([
            "image/jpg",
            "image/png",
            "image/jpeg",
        ]);

        $this->FileMananger->setPath($path);
        $uploaded_figures = [];
        $files = $request->file('mansucript_figures');
        // return $files;
        foreach ($files as $figure) {
            # code...

            $is_uploaded = $this->FileMananger->uploadFile($figure);
            // return $is_uploaded;
            if (!$is_uploaded) {
                return false;
            }

            array_push($uploaded_figures, $is_uploaded);
        }
        return $uploaded_figures;

    }
    public function isValidAuthors(Request $request)
    {
        $rules_all = [
            "manuscript_authors" => "required|array",
        ];
        $messages = [
            "required" => "You must provide at least one author for the submission",
        ];
        $no_authors = $this->isValidRequest($request->all(), $rules_all, $messages);
        if ($no_authors !== true) {
            return $no_authors;
        }

        $authors = $request->manuscript_authors;
        foreach ($authors as $key => $author) {
            $author = json_decode($author, true);
            // var_dump($author);
            $rule = [
                "email" => "required|email",
                "first_name" => "required|string|min:2|max:45",
                "second_name" => "nullable|string|min:2|max:45",
                "gender" => "required|integer|in:0,1",
                "institute" => "required|string|min:4|max:45",
                "location" => "required|string|min:4|max:45",
            ];
            $messages = [
                "required" => "The :attribute of the author number " . ($key + 1) . " is required ",
                "string" => "The :attribute of the author number " . ($key + 1) . " is must be string ",
                "integer" => "The :attribute of the author number " . ($key + 1) . " is must be integer ",
                "in" => "The :attribute of the author number " . ($key + 1) . " is must be male or female ",
                "min" => "The :attribute of the author number " . ($key + 1) . " cannot be less than :min characters ",
                "max" => "The :attribute of the author number " . ($key + 1) . " cannot be more than :max characters ",
            ];
            $new_req = new Request();
            $new_req->setMethod('POST');
            $new_req->request->add(['email' => $author['email']]);
            $new_req->request->add(['first_name' => $author['first_name']]);
            $new_req->request->add(['second_name' => $author['second_name']]);
            $new_req->request->add(['gender' => $author['gender']]);
            $new_req->request->add(['institute' => $author['institute']]);
            $new_req->request->add(['location' => $author['location']]);
            $author_error = $this->isValidRequest($new_req->all(), $rule, $messages);
            if ($author_error !== true) {
                return $author_error;
            }

        }
        return true;

    }
    public function isValidRequestForSubmission(Request $request)
    {
        $rules = [
            "mansucript_type" => "required|in:0,1,2,3",
            "manuscript_title" => "required|min:15|max:150",
            "manuscript_abstract" => "required|min:50|max:120000",
            "mansucript_keywords" => "required|min:15|max:230",
            "mansucript_file" => "required|file",
            "mansucript_cover" => "required|file",
            "mansucript_figures.*src" => "required|file",
        ];
        return $this->isValidRequest($request->all(), $rules, []);

    }
    public function isValidRequest($request, $rules, $messages = [])
    {
        $is_valid = Validator::make($request, $rules, $messages);

        $isNotValidRequest = $this->CustomValidator->isNotValidRequest($is_valid);
        if ($isNotValidRequest) {
            return $isNotValidRequest;
        }

        return true;
    }
    public function UploadManuscript($manuscript_file, $user_profile)
    {

        $path = "uploads/" . $user_profile->user_token . "/submissions/$this->submision_folder/";

        $this->FileMananger->setExtension([
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.template",
        ]);

        $this->FileMananger->setPath($path);

        $is_uploaded = $this->FileMananger->uploadFile($manuscript_file);
        return $is_uploaded;
    }

    public function openPendingSubmissions(Request $request)
    {
        $user = $request->user();
        $pending_submission = $user->allSubmissions()->where('submission_status', 0)
            ->orWhere('submission_status', 1)->orderBy('updated_at', 'DESC')->get();
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.pending', compact('pending_submission', 'has_profile'));
    }

    public function openAcceptedSubmissions(Request $request)
    {
        $user = $request->user();
        $accepted_submissions = $user->allSubmissions()->where('submission_status', 4)->orderBy('updated_at', 'DESC')->get();
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.accepted', compact('accepted_submissions', 'has_profile'));
    }
    public function openRejectedSubmissions(Request $request)
    {
        $user = $request->user();
        $rejected_submissions = $user->allSubmissions()->where('submission_status', 3)->orderBy('updated_at', 'DESC')->get();
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.rejected', compact('rejected_submissions', 'has_profile'));
    }
    public function openResentSubmissions(Request $request)
    {
        $user = $request->user();
        $resent_submissions = $user->allSubmissions()->where('submission_status', 2)->orderBy('updated_at', 'DESC')->get();
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        return view('submissions.resent', compact('resent_submissions', 'has_profile'));
    }

    public function viewUserSubmission(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }

        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $submission = $view_sub[0];
        return view('submissions.view', compact('submission', 'has_profile'));
    }

    public function editManuscript(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $submission = $view_sub[0];
        return view('submissions.edit_man', compact('submission', 'has_profile'));
    }
    public function doEditManuscript(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $rules = [
            "submission_abstract" => "required|string|max:120000",
            "submission_keywords" => "required|string|max:230",
            "submission_manuscript" => "nullable|file|max:20000",
            "submission_cover" => "nullable|file|max:20000",
        ];
        $successmessage = [];
        $submission = $view_sub[0];
        // return $submission;
        $is_valid = $request->validate($rules);
        $user_profile = $user->profileData;
        // return $is_valid;
        if ($request->submission_manuscript != null) {
            $manu_url = $this->UploadManuscript($request->file('submission_manuscript'), $user_profile);
            if ($manu_url === false) {
                // return "we have failed ";
                return Redirect::back()->withErrors(["submission_manuscript" => $this->FileMananger->getError()])->withInput($is_valid);
            }

            // return Redirect::back()->withErrors(["submission_manuscript" => $this->FileMananger->getError()]);
            else {
                // return "we are hre";
                $updated = $submission->update([
                    "submission_manuscript" => $manu_url,
                ]);
                array_push($successmessage, "Successfully updated transcript manuscript file ");
            }
        }

        if ($request->submission_cover != null) {
            $cover_url = $this->UploadManuscript($request->file('submission_cover'), $user_profile);
            if ($cover_url === false) {
                return Redirect::back()->withErrors(["submission_cover" => $this->FileMananger->getError()])->withInput($is_valid);
            } else {
                $updated = $submission->update([
                    "submission_cover" => $cover_url,
                ]);
                array_push($successmessage, "Successfully updated transcript cover ");
            }
        }
        if (strcmp($request->submission_abstract, ($submission->submission_abstract))) {
            $updated = $submission->update([
                "submission_abstract" => $request->submission_abstract,
            ]);
            array_push($successmessage, "Successfully updated transcript abstract ");
        }

        if (strcmp($request->submission_keywords, ($submission->submission_keywords))) {
            $updated = $submission->update([
                "submission_keywords" => $request->submission_keywords,
            ]);
            array_push($successmessage, "Successfully updated transcript keywords ");
        }

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;
        // return $updated;
        $submission = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get()[0];
        return view('submissions.edit_man', compact('submission', 'has_profile', 'successmessage'));
    }

    public function editManuscriptAuthors(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $submission = $view_sub[0];
        return view('submissions.edit_authors', compact('submission', 'has_profile'));
    }
    public function doEditManuscriptAuthors(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $submission = $view_sub[0];

        $rules = [
            "author_firstname" => "required|string|max:45",
            "author_secondname" => "required|string|max:45",
            "author_email" => "required|email|max:45",
            "author_institution" => "required|string|max:75",
            "author_location" => "required|string|max:45",
            "author_sex" => "required|integer|in:0,1",
        ];
        $is_valid = $request->validate($rules);
        $author_exists = submissionAuthorsModel::where("author_email", $request->author_email)->exists();
        if ($author_exists) {
            return Redirect::back()->withErrors(["author_email" => "The author email exists."])->withInput($is_valid);
        }

        $sub_authors = submissionAuthorsModel::create([
            "submission_id" => $submission->id,
            "submission_token" => $submission->submssion_token,
            "author_firstname" => $request->author_firstname,
            "author_secondname" => $request->author_secondname,
            "author_email" => $request->author_email,
            "author_institute" => $request->author_institution,
            "author_location" => $request->author_location,
            "author_gender" => $request->author_sex,
        ]);
        $submission = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get()[0];
        return view('submissions.edit_authors', compact('submission', 'has_profile'));
    }

    public function editManuscriptFiles(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        // phpinfo();
        $submission = $view_sub[0];
        return view('submissions.edit_figures', compact('submission', 'has_profile'));
    }

    public function doEditManuscriptFiles(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $submission = $view_sub[0];
        $rules = [
            "submission_figures" => "required|file|max:10000",
        ];
        $is_valid = $request->validate($rules);
        $paths = explode("/", $submission->submission_manuscript);
        $submision_folder = $paths[count($paths) - 2];
        $path = "uploads/" . $user_profile->user_token . "/submissions/$submision_folder/";
        $this->FileMananger->setExtension([
            "image/jpg",
            "image/png",
            "image/jpeg",
        ]);

        $this->FileMananger->setPath($path);
        $uploaded_figures = [];
        $is_uploaded = $this->FileMananger->uploadFile($request->file('submission_figures'));
        if (!$is_uploaded) {
            return Redirect::back()->withErrors(["submission_figures" => $this->FileMananger->getError()]);
        }

        $num_files = $submission->subFiles->count();
        $added = submissionFilesModel::create([
            "submission_id" => $submission->id,
            "submission_token" => $submission->submssion_token,
            "submission_file" => $is_uploaded,
            "submission_file_index" => $num_files,

        ]);
        $submission = $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get()[0];

        return view('submissions.edit_figures', compact('submission', 'has_profile'));
    }

    public function remSubmissionAuthor(Request $request, $sub_id, $author_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $author = submissionAuthorsModel::where([
            ["submission_id", $sub_id],
            ["id", $author_id],
        ])->get();
        if ($view_sub[0]->subAuthors->count() <= 1) {
            return Redirect::back()->withErrors(['error' => 'Can not remove all authors, you must have at least one author']);
        }

        $successmessage = [];
        if ($author->count() > 0) {
            $author[0]->delete();
            array_push($successmessage, "The author has been removed from the list");
        }
        $submission = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get()[0];
        return Redirect::back()->with(['submission' => $submission, 'has_profile' => $has_profile, 'successmessage' => $successmessage]);
    }
    public function remSubmissionFigure(Request $request, $sub_id, $figure_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;

        $figures = submissionFilesModel::where([
            ["submission_id", $sub_id],
        ])->get();
        if ($figures->count() <= 1) {
            return Redirect::back()->withErrors(['error' => 'Can not remove all figures, you must have at least one figure']);
        }
        $figure = submissionFilesModel::where([
            ['id', $figure_id],
            ['submission_id', $sub_id],
        ])->get();
        $successmessage = [];
        if ($figure->count() > 0) {
            $figure[0]->delete();
            array_push($successmessage, "The figure has been removed from the list");
        }
        $submission = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get()[0];
        return Redirect::back()->with(['submission' => $submission, 'has_profile' => $has_profile, 'successmessage' => $successmessage]);
    }

    public function ResubmitUserSubmission(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get();
        if ($view_sub->count() <= 0) {
            abort(404);
        }
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() >= 1;
        if ($view_sub[0]->submission_status !== 2) {
            return Redirect::back()->withErrors(["submission" => "Cannot resubmit this submission"]);
        }

        $view_sub[0]->update([
            "submission_status" => 0,
        ]);
        $successmessage = [];
        array_push($successmessage, "successfully resent the submission");
        $submission = $user->allSubmissions()->where([
            ['user_id', $user->id],
            ['id', $sub_id],
        ])->get()[0];
        return Redirect::back()->with(['submission' => $submission, 'has_profile' => $has_profile, 'successmessage' => $successmessage]);
    }
}
