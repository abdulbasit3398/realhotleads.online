<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GroupMessage extends Model
{
    protected $table = 'group_messages';

    protected $guarded=[];

    public function group(){
        return $this->belongsTo(Group::class,'group_id');
    }

    public function sender(){
        return $this->belongsTo(User::class,'sender_id');
    }
    public function getCreatedAtAttribute($value) {
        return $this->attributes['created_at'] = Carbon::parse($value)->format('h:i a');
    }
}
