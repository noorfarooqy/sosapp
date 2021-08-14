<?php

namespace App\Http\Livewire;

use App\Services\ContactUsServices;

class ContactUsForm extends DefaultComponent
{
    public $first_name;
    public $last_name;
    public $email;
    public $subject;
    public $message;

    public function sendFeedback()
    {
        $this->hideMessages();
        $request = $this->newRequest();
        $request->merge([
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "email" => $this->email,
            "subject" => $this->subject,
            "message" => $this->message,
        ]);
        $ContactServices = new ContactUsServices();
        $feed = $ContactServices->createNewFeed($request);
        if($feed)
        {
            $this->success_message = "Succesfully sent your feedback.";
        }
        else{
            $this->error_message = $ContactServices->getMessage();
        }

    }
    public function render()
    {
        return view('livewire.contact-us-form');
    }
}
