<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    
    protected $table = "contact_us";

    const TABLE_NAME = "contact_us";

    const ID = "id";
    const NAME = "name";
    const EMAIL = "email";
    const MOBILE = "mobile";
    const TOPIC = "topic";
    const MESSAGE = "message";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
}
