<?php

namespace App;

use App\User;
use App\UserContact;
use Illuminate\Database\Eloquent\Model;

class UserSmsHistory extends Model
{
    protected $table = 'user_sms_history';

    public function contact()
    {
        return $this->belongsTo(UserContact::class,'contact_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
