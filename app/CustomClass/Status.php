<?php
namespace App\CustomClass;

class Status
{

    protected $error_message;
    protected $error_status;
    protected $success_message;
    protected $data;

    public function __construct()
    {
        $this->resetStatus();
    }
    public function resetStatus()
    {
        $this->error_message = null;
        $this->error_status = null;
        $this->success_message = null;
        $this->data = null;
    }

    public function setError($error)
    {
        $this->error_message = $error;
        $this->error_status = true;
    }
    public function setSuccess($data, $success_message = "success")
    {
        $this->error_status = false;
        $this->success_message = $success_message;
        $this->data = $data;
    }

    public function getError()
    {
        return \json_encode([
            "error_message" => $this->error_message,
            "error_status" => $this->error_status,
        ]);
    }
    public function getSuccess()
    {
        return \json_encode([
            "success_message" => $this->success_message,
            "data" => $this->data,
        ]);
    }
}
