<?php

namespace App\Models\Business\Task;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business\Department\Department;
use App\Models\Business\Employee\Employee;
use App\Models\Business\User\EmployeeUser;
use App\Models\User;
use App\Models\Business\TaskStatus\TaskStatus;

class Task extends Model
{
    protected $fillable = [
        'user_id',
        'task_status_id',
        'name',
        'description',
        'conclusion_date',
        'priority',
        'order',
    ];


    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}

