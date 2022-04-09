<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FunnelType extends Model
{
    protected $guarded=[];


    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
}
