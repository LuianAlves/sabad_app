<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class SubTask extends Model
{
    protected $primaryKey = 'subtask_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'parent_task_id','name','task_status_id',
        'responsible','due_date','attachments'
    ];

    protected $casts = [
        'attachments' => 'array',
        'responsible' => 'array'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }

    public function task()
    {
        return $this->belongsTo(Task::class, 'parent_task_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'task_status_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'responsavel');
    }
}
