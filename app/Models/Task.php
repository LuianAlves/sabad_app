<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Task extends Model
{
    protected $primaryKey = 'task_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order', 'name','description','due_date','priority',
        'responsible','task_status_id','attachments',
        'tags','checklist','quick_notes'
    ];

    protected $casts = [
        'order'         => 'integer',
        'responsible' => 'array',
        'attachments'  => 'array',
        'tags'         => 'array',
        'checklist'    => 'array',
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

    public function status()
    {
        return $this->belongsTo(TaskStatus::class,'task_status_id');
    }
    public function subtasks()
    {
        return $this->hasMany(Subtask::class,'parent_task_id');
    }
    public function documents()
    {
        return $this->hasMany(TaskDocument::class,'task_id');
    }

    public function permissionsTask()
    {
        return $this->hasMany(TaskUserRole::class, 'task_id');
    }

    public function owners()
    {
        return $this->permissionsTask()->where('role', 'owner')->with('user');
    }

    public function editors()
    {
        return $this->permissionsTask()->where('role', 'editor')->with('user');
    }

    public function readers()
    {
        return $this->permissionsTask()->where('role', 'reader')->with('user');
    }
}
