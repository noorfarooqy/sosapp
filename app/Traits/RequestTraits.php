<?php
namespace App\Traits;

use App\Traits\ErrorParser;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Validator;

Trait RequestTraits
{
    use ErrorParser;
    use ResponseTrait;
    protected $Validator;
    public $has_failed = false;
    public function CustomValidate (){
        $this->Validator = Validator::make($this->request->all(), $this->rules);
        $this->has_failed = $this->Validator->fails();
        $this->setError($this->Validator->errors()->first());
    }
    public function ValidatedData(){
        return $this->Validator->validated();
    }
    public function ResponseType(){
        return $this->request->expectsJson();
    }
    public function requestDataExcept($except){
        return $this->request->except($except);
    }
    public function paginate()
    {
        return $this->request->filled('paginate') ? $this->request->paginate : 10;
    }

}
