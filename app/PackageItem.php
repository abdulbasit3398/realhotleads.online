<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    protected $guarded=[];
    protected $table = 'pacakge_items';
    public $timestamps = false;


    public function package(){
        return $this->belongsTo(Package::class,'package_id');
    }

    public function product(){
        return $this->belongsTo(Product::class,'product_id');
    }

}
