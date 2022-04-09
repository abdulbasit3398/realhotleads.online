<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCpanelEmailAddress extends Model
{
    protected $table = 'user_cpanel_email_address';
    protected $fillable = ['user_id','email_address','password'];
}
