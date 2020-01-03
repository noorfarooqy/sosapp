<?php
namespace App\CustomClass;

// use 
use File;

class FileManager
{

    protected $filename ;
    protected $upload_path;
    protected $url_link;

    protected $Status;
    protected $Valid_Extensions;

    public function __construct()
    {
        $this->Status = new Status();
        $this->Valid_Extensions = [];
    }
    public function uploadFile($file)
    {
        if(count($this->Valid_Extensions) <= 0)
        {
            $this->Status->setError(["The file extension is not set"]);
            return false;
        }

        $ext = $file->getClientOriginalExtension();
        if(!in_array($ext, $this->Valid_Extensions))
        {
            $this->Status->setError(["invalid file given "]);
            return false;  
        }
        $this->filename = time()."_".$file->getClientOriginalName();

        if(strlen($this->filename) <= 0)
        {
            $this->Status->setError(["The filename could not be fetched "]);
            return false;
        }
        if($this->upload_path === null)
        {
            $this->Status->setError(["The upload path is not set"]);
            return false;
        }
        $path = $this->upload_path.$this->filename;
        $is_uploaded = Storage::disk('public')->put($path);
        if($is_uploaded)
        {
            return $path;
        }
        
        $this->Status->setError(["Failed to upload file", $path]);
        return false;

    }

    public function setExtension($extensions)
    {
        if(is_array($extensions))
        {
            $this->Valid_Extensions = $extensions;
        }
    }
    public function setPath($path)
    {
        $this->upload_path = $path;
    }


    public function getError()
    {
        return $this->Status->getError();
    }
    
}
