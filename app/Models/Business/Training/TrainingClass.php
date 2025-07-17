<?php

namespace App\Models\Business\Training;

use App\Models\Business\Employee\Employee;
use App\Models\Business\Room\Room;
use Illuminate\Database\Eloquent\Model;

class TrainingClass extends Model
{
    protected $fillable = [
        'training_id',
        'room_id',
        'instructor_id',
        'external_instructor_name',
        'external_instructor_email',
        'capacity',
        'start_date',
        'end_date'
    ];

    public function training() {
        return $this->belongsTo(Training::class);
    }

    public function participants() {
        return $this->belongsToMany(Employee::class,'training_participants','training_class_id','employee_id')
            ->withTimestamps();
    }

    public function instructor()
    {
        return $this->belongsTo(Employee::class, 'instructor_id', 'id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
