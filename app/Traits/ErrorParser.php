<?php
namespace App\Traits;
Trait ErrorParser
{

    protected $error_message;

    public function setError($error, $description=" processing your request"){
        if(env('APP_DEBUG') == true){
            $this->error_message = $error;
        }
        else
            $this->error_message = "Oops! Something went wrong while $description. Please try again";
    }

    public function getMessage(){
        return $this->error_message;
    }
    public function getError($error="")
    {
        return "Oop! Something went wrong in $error";
    }
}
