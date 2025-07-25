<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class TaskStatus extends Model
{
    protected $primaryKey = 'task_status_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['name','order','color'];

    // Gera UUID ao criar
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Uuid::uuid4()->toString();
            }
        });
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_status_id');
    }
}
