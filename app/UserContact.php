<?php

namespace App;

use App\UserSmsHistory;
use Illuminate\Database\Eloquent\Model;

class UserContact extends Model
{
    protected $table = 'user_contacts';

    protected $fillable = [
        'user_id',
        'contact_name',
        'contact_phone',
        'contact_email',
        'company_name',
        'notes',
    ];
    
    public function sms_history()
    {
        return $this->hasMany(UserSmsHistory::class,'contact_id');
    }
}
