<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $guarded=[];


    public function getCreatedAtAttribute($value) {
        return $this->attributes['created_at'] = Carbon::parse($value)->format('h:i a');
    }


    public function conversation(){
        return $this->belongsTo(Conversation::class,'conversation_id');
    }

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function receiver(){
        return $this->belongsTo(User::class,'rcvr_id');
    }

}
