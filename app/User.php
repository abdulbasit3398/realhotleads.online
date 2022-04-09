<?php

namespace App;

use Auth;
use App\UserWallet;
use App\UserInventory;
use App\UserBankDetail;
use App\UserPackageDetail;
use App\UserPhoneNumber;
use App\UserWithdrawalRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;


    protected $fillable = [
        'username', 'email', 'password','website','current_package','payment_id','referrer_id','package_validation','total_contacts','remaining_contacts','affiliate_account','first_name','last_name','company_name'
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_package()
    {
        return $this->hasMany(UserPackageDetail::class,'user_id');
    }
    public function getPackagePriceAttribute()
    {
        return $this->user_package->sum('package_price');
    }
    public function inventory()
    {
        return $this->hasMany(UserInventory::class,'user_id');
    }
    public function contacts_available()
    {
        return $this->inventory()->where('product_name','contacts');
    }
    public function check_contacts_availability($date)
    {
        $inventry = $this->inventory()->where('product_name','contacts')->first();
        if($inventry)
        {
            if($inventry->quantity == '-1')
            {
                $contact_date = strtotime($date);
                $validity = strtotime($inventry->validity);
                if($contact_date <= $validity)
                    return '-1';
                else
                {
                    $inventry->delete();
                    return '0';
                }

            }
            elseif($inventry->validity == '-1')
            {
                return $inventry->quantity;
            }
        }
        return '0';
    }
    public function user_wallet()
    {
        return $this->hasOne(UserWallet::class,'user_id');
    }
    public function bank_detail($value)
    {
        $val = UserBankDetail::where([['user_id',Auth::id()],['attr_name',$value]])->first();
        if($val)
            return $val->attr_value;
        else
            return '';
    }
    public function user_bank_detail($user_id,$value)
    {
        $val = UserBankDetail::where([['user_id',$user_id],['attr_name',$value]])->first();
        if($val)
            return $val->attr_value;
        else
            return '';
    }
    public function withdrawl_request($status)
    {
        $amount = 0;
        $amount = UserWithdrawalRequest::where([['user_id',Auth::id()],['status',$status]])->count('amount');

        return $amount;
    }
    public function signal_wire_phone_number()
    {
        return $this->hasOne(UserPhoneNumber::class,'user_id');
    }

    public function conversations () {
        return $this->hasMany(Conversation::class,'sender_id');
    }

    public function getFullNameAttribute (){
        $name = $this->first_name ." ". $this->last_name;

        if(strlen($this->first_name) < 1 && strlen($this->last_name) <1)
            return 'No name';
        return $name;
    }

    public function events(){
        return $this->hasMany(Event::class);
    }
}
