<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GroupMember extends Model
{
    protected $table = 'group_members';

    protected $guarded=[];
    protected $time=[];
    public $timestamps = false;

    public function group(){
        return $this->belongsTo(Group::class,'group_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
