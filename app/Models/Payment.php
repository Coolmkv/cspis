<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = "payments";

    const TABLE_NAME = "payments";

    const ID = "id";
    const R_PAYMENT_ID = "r_payment_id";
    const METHOD = "method";
    const CURRENCY = "currency";
    const USER_EMAIL = "user_email";
    const INVOICE_NUMBER = "invoice_number";
    const AMOUNT = "amount";
    const STUDENT_ID = "student_id";
    const JSON_RESPONSE = "json_response";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";
    
    const ALIAS_CREATED_AT = "payments.created_at";
}
