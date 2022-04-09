<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class WalletTransection extends Model
{
    protected $table = 'wallet_transection';

    public function sender_recipient_user()
    {
        return $this->belongsTo(User::class,'sender_or_recipient');
    }
}
