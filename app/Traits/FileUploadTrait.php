<?php
namespace App\Traits;

use Illuminate\Support\Facades\Storage;

Trait FileUploadTrait
{
    use ErrorParser;

    
    public function UploadPublicFile($image, $path="uploads/misc"){
        try {
            $file_path = Storage::disk('public')->putFile($path, $image);
            return $file_path;
        } catch (\Throwable $th) {
            $this->setError($th->getMessage());
            return false;
        }
    }
}
