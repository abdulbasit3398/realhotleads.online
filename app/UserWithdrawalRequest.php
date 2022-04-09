<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserWithdrawalRequest extends Model
{
    protected $table = 'user_withdrawal_request';

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
