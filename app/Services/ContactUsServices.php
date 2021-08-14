<?php
namespace App\Services;

use App\Mail\NewContactUsFeedMail;
use App\Mail\ContactFeedbackReceivedMail;
use App\Models\ContactUsModel;
use Illuminate\Support\Facades\Mail;

class ContactUsServices extends DefaultService
{

    public function __construct()
    {
        $this->Model = new ContactUsModel();
    }
    public function createNewFeed($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();

        $this->rules = [
            "first_name" => "required|string|max:132",
            "last_name" => "required|string|max:132",
            "email" => "required|email",
            "subject" => "required|string|max:124",
            "message" => "required|string|max:1024",
        ];

        $this->CustomValidate();
        if($this->has_failed)
            return $is_json ? $this->_422Response($this->getMessage()) : false;
        $data = $this->ValidatedData();

        $feed = $this->Model->createNewContactFeed($data);
        if($feed){
            Mail::to(env("APP_ADMIN_EMAIL", 'noor@drongo.vip'))->send(new NewContactUsFeedMail($feed));
            Mail::to($feed->email)->send(new ContactFeedbackReceivedMail($feed));
            return $is_json ? $this->Parse(false, 'success', $feed) : $feed;
        }

        $this->setError($message = $this->Model->getMessage());
        return $is_json  ? $this->_422Response($message) : false;
    }

    public function getAllFeedbacks($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();

        $feeds = $this->Model->orderBy('id')->paginate($this->paginate());

        return $is_json ? $this->Parse(false, 'success', $feeds) : $feeds;
    }
    public function getUnreadFeedbacks($request)
    {
        $this->request = $request;
        $is_json = $this->ResponseType();

        $feeds = $this->Model->where('is_viewed', false)->orderBy('id')->paginate($this->paginate());

        return $is_json ? $this->Parse(false, 'success', $feeds) : $feeds;
    }
}
