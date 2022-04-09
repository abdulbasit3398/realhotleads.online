<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'groups';

    protected $guarded=[];


    public function owner(){
        return $this->belongsTo(User::class,'owner_id');
    }

    public function messages(){
        return $this->hasMany(GroupMessage::class,'group_id');
    }


    public function members(){
        return $this->hasMany(GroupMember::class);
    }

}
