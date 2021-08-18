<?php

namespace App\Traits;

Trait FancyUploaderTrait
{
    use ErrorParser, FileUploadTrait;

    public function __construct()
    {
        $this->fancy_success = false;
        $this->fancy_filename = null;
        
    }

    public function FancyUploadFile($file, $path)
    {
        $uploaded = $this->UploadPublicFile($file, $path);
        if($uploaded){
            return $this->SuccessResponse($uploaded);
        }
        else{
            return $this->ErrorResponse($this->getMessage());
        }
    }


    public function SuccessResponse($filename=null)
    {
        $this->fancy_success = true;
        $this->fancy_filename = $filename;
        return json_encode(["success"=> true, "filename" => $filename]);
    }public function ErrorResponse($error="Failed to save the file", $code=422)
    {
        return json_encode(["success"=> false,"error" => $error, "errorcode" => $code]);
    }
}
