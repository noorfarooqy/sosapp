<?php
namespace App\Services;

use App\Traits\ErrorParser;
use App\Traits\FancyUploaderTrait;
use App\Traits\FileUploadTrait;
use App\Traits\RequestTraits;
use App\Traits\ResponseTrait;

abstract class DefaultService
{
    use ErrorParser, RequestTraits, ResponseTrait, FileUploadTrait, FancyUploaderTrait;
}
