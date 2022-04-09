<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomPackageRequest extends Model
{
    protected $table = 'custom_package_requests';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
