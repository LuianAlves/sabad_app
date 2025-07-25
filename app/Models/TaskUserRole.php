<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class TaskUserRole extends Model
{
    protected $table = 'task_user_role';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['task_id','user_id','role'];

    public static function boot()
    {
        parent::boot();

        static::creating(fn($m)=>$m->id = Uuid::uuid4()->toString());
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function task() {
        return $this->belongsTo(Task::class,'task_id');
    }
}
