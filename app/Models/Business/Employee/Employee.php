<?php

namespace App\Models\Business\Employee;

use App\Models\Business\Department\Department;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'hierarchical_level',
        'hired_in',
        'fired_in',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Department::class);
    }
}
    

