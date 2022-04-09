<?php

namespace App;

use App\FunnelType;
use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
    protected $guarded=[];


    public function files()
    {
        return $this->morphMany(File::class, 'fileable');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function funnel_type()
    {
        return $this->belongsTo(FunnelType::class, 'funnel_id');
    }
}
