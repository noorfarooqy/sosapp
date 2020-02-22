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

        $has_profile = $user_profile !== null && $user_profile->count() === 1;
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
        $authors = $request->manuscript_authors;

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
        }

        $this->Status->setSuccess(["man" => $uploaded_manuscript, "cover" => $uploaded_cover, "figures" => $uploaded_figures]);
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
            "image/tif",
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
            "manuscript_abstract" => "required|min:50|max:1000",
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
        $pending_submission = $user->allSubmissions()->where('submission_status',0)->get();
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() === 1;

        return view('submissions.pending', compact('pending_submission', 'has_profile'));
    }

    public function viewUserSubmission(Request $request, $sub_id)
    {
        $user = $request->user();
        $view_sub = $user->allSubmissions()->where([
            ['user_id',$user->id],
            ['id', $sub_id]
        ])->get();
        if($view_sub->count() <= 0)
            abort(404);
        $user_profile = $user->profileData;

        $has_profile = $user_profile !== null && $user_profile->count() === 1;

        return view('submission.view', compact('view_sub', 'has_profile'));
    }
}
