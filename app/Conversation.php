<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';

    protected $guarded=[];


    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }

    public function receiver(){
       return $this->belongsTo(User::class,'rcvr_id');
    }


    public function messages(){
        return $this->hasMany(Message::class);
    }
}
