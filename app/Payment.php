<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'user_id',
        
        'reference',
        'gateway',
       
    ];

   

}
