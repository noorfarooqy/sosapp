<?php

namespace App\CustomClasses;

class ResponseParser
{


    public static function Parse($status, $message, $data = [], $code = 200, $file = '')
    {
        return response()->json([
            "error_status" => $status,
            "message" => $message,
            "data" => $data,
            "code" => $code,
            "file" => $file
        ]);
    }

    public static function _404Reponse($info = "")
    {
        return response()->json([
            "error_status" => true,
            "message" => "404 - $info Not found",
            "data" => [],
            "code" => 404,
        ]);
    }
    public static function _403Reponse($info = "")
    {
        return response()->json([
            "error_status" => true,
            "message" => "403 - $info Permission denied",
            "data" => [],
            "code" => 403,
        ]);
    }
}
