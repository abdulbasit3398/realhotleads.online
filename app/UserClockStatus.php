<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserClockStatus extends Model
{
	protected $table = 'user_clock_status';

	public function user()
	{
		return $this->belongsTo(User::class,'user_id');
	}
}