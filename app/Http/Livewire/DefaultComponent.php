<?php
namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DefaultComponent extends Component
{
    public $error_message;
    public $success_message;
    

    public function hideMessages()
    {
        $this->error_message = null;
        $this->success_message = null;
    }
    public function newRequest()
    {
        $request = new Request();
        if(!is_null(Auth::user()))
            $request->setUserResolver(function(){
                return Auth::user();
            });
        return $request;
    }
}
