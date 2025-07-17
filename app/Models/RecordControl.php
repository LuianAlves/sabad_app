<?php

namespace App\Models;

use App\Models\Business\Department\Department;
use App\Models\Business\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecordControl extends Model
{
    use HasFactory;

    // RecordControl.php
    public function employee() {
        return $this->belongsTo(Employee::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

}
