<?php

namespace App;

use App\UserTaskManagement;
use Illuminate\Database\Eloquent\Model;

class TaskManagementMember extends Model
{
    protected $table = 'task_management_members';

    public function task_management()
    {
        return $this->belongsTo(UserTaskManagement::class,'task_management_id');
    }
}
