<?php

namespace App\Models;

use App\Traits\ErrorParser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ContactUsModel extends Model
{
    use HasFactory, ErrorParser;
    protected $table = "contacts";
    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "subject",
        "message",
        "is_viewed_by",
        "is_replied",
        "last_viewed_by",
    ];

    public function createNewContactFeed($data)
    {
        try {
            $feed = $this->create($data);
            return $feed;
        } catch (\Throwable $th) {
            $this->setError(env('APP_DEBUG') ? $th->getMessage() : $this->getError(" creating new feedback"));
            return false;
        }
    }
    public function getFullName()
    {
        return $this->first_name." ".$this->last_name;
    }
}
