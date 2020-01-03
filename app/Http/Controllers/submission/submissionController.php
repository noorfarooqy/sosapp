<?php

namespace App\Http\Controllers\submission;

use App\CustomClass\CustomValidator;
use App\CustomClass\FileManager;
use App\CustomClass\Status;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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

        $this->Status->setSuccess(["man" => $uploaded_manuscript, "cover" => $uploaded_cover]);
        return $this->Status->getSuccess();
        

        
    }
    public function setManuscriptAuthors(Request $request)
    {
        $is_valid = $this->isValidAuthors($request);
        
        if($is_valid !== true)
            return $is_valid;
        
        $this->Status->setSuccess(["We are good here "]);
        return $this->Status->getSuccess();
    }
    public function setManuscriptFiles(Request $request)
    {
        $is_valid = $this->isValidFiles($request);
    }
    public function isValidFiles($request)
    {
        $rules = [

        ];

        return $this->isValidRequest($request, $rules,[]);
    }
    public function isValidAuthors(Request $request)
    {
        $rules_all = [
            "authors" => "required|array"
        ];
        $messages =[
            "required" => "You must provide at least one author for the submission",
        ];
        $no_authors = $this->isValidRequest($request->all(), $rules_all, $messages);
        if($no_authors !== true)
            return $no_authors;
        $authors = $request->get('authors');
        foreach($authors as $key => $author)
        {
            $rule = [
                "email" =>"required|email",
                "first_name" => "required|string|min:2|max:45",
                "gender" => "required|integer|in:0,1",
                "institute" => "required|string|min:4|max:45",
                "location" => "required|string|min:4|max:45"
            ];
            if($author['second_name'])
                array_push($rule, ["second_name", "string|min:2|max:45"]);
            $messages = [
                "required" => "The :attribute of the author number ".($key+1)." is required ",
                "string" => "The :attribute of the author number ".($key+1)." is must be string ",
                "integer" => "The :attribute of the author number ".($key+1)." is must be integer ",
                "in" => "The :attribute of the author number ".($key+1)." is must be male or female ",
                "min" => "The :attribute of the author number ".($key+1)." is cannot be less than :min characters ",
                "max" => "The :attribute of the author number ".($key+1)." is cannot be more than :max characters ",
            ];
            $new_req = new Request();
            $new_req->setMethod('POST');
            $new_req->request->add(['email'=>$author['email']]);
            $new_req->request->add(['first_name'=>$author['first_name']]);
            $new_req->request->add(['second_name'=>$author['second_name']]);
            $new_req->request->add(['gender'=>$author['gender']]);
            $new_req->request->add(['institute'=>$author['institute']]);
            $new_req->request->add(['location'=>$author['location']]);
            $author_error = $this->isValidRequest($new_req->all(), $rule, $messages);
            if($author_error !== true)
                return $author_error;
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
            "mansucript_file" => "required",
            "mansucript_cover" => "required",
        ];
        return $this->isValidRequest($request->all(), $rules, []);
        
    }
    public function isValidRequest($request, $rules, $messages=[])
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
        $submision_folder = Str::random(15)."_".time();
        $path = "/uploads/" . $user_profile->user_token . "/submissions/$submision_folder/";
        
        $this->FileMananger->setExtension([
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.template"
        ]);

        $this->FileMananger->setPath($path);

        $is_uploaded = $this->FileMananger->uploadFile($manuscript_file);
        return $is_uploaded;
    }
}
