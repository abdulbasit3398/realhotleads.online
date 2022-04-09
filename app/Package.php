<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $guarded=[];
    protected $table = 'pacakages';
    public $timestamps = false;


    public function tag(){
        return $this->belongsTo(PackageTag::class,'package_tag_id');
    }

    public function items(){
        return $this->hasMany(PackageItem::class,'package_id');
    }
}
