<?php

namespace App;

use App\TaskManagementMember;
use Illuminate\Database\Eloquent\Model;

class UserTaskManagement extends Model
{
    protected $table = 'user_task_management';

    public function team_members()
    {
        return $this->hasMany(TaskManagementMember::class,'task_management_id');
    }
    
}
