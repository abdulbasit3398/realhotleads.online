<?php

namespace App;

use App\User;
use App\UserPhoneNumber;
use Illuminate\Database\Eloquent\Model;

class BulkSmsEmail extends Model
{
    protected $table = 'bulk_sms_email';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function user_phone_number()
    {
        return $this->belongsTo(UserPhoneNumber::class,'user_id','user_id');
    }
}
