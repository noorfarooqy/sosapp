<?php

namespace App\Traits;

Trait ResponseTrait{


    protected $defaultMessage = "Oops! Something went wrong. Please try again or inform the support team";
    public function Parse($status, $message, $data = [], $code = 200, $file = '')
    {
        if($status){
            $response = [
                "error_status" => $status,
                "error_message" => $message,
                "data" => $data,
                "code" => $code,
                "file" => $file
            ];
        }
        else
            $response = [
                "success_message" => $message,
                "data" => $data,
                "code" => $code,
                "file" => $file
            ];
        return response()->json($response);
    }

    public function _404Response($info = "")
    {
        return response()->json([
            "error_status" => true,
            "success_message" => "404 - $info Not found",
            "data" => [],
            "code" => 404,
        ],404);
    }
    public function _403Response($info = "")
    {
        return response()->json([
            "error_status" => true,
            "error_message" => "403 - $info unauthenticated action",
            "data" => [],
            "code" => 403,
        ],403);
    }
    public function _401Response($info = "")
    {
        return response()->json([
            "error_status" => true,
            "error_message" => "401 - $info permission denied",
            "data" => [],
            "code" => 401,
        ],401);
    }
    public function _422Response($info = "Invalid request body")
    {
        return response()->json([
            "error_status" => true,
            "error_message" => $info,
            "data" => [],
            "code" => 422,
        ],422);
    }
    public function _500Response($info = "Server error")
    {
        return response()->json([
            "error_status" => true,
            "error_message" =>  $info,
            "data" => [],
            "code" => 500,
        ],500);
    }
    public function PlainResponse($message, $scafold = false){
        (env('APP_DEBUG') == true && !$scafold) ? $message : $this->defaultMessage;
    }
}