<?php

namespace App\Models\Business\Employee;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\User\EmployeeUser;
use App\Models\Business\Email\Email;
use App\Models\Business\Company\Company;
use App\Models\Business\Department\Department;
use App\Models\Business\Certificate\Certificate;

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

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function employeeUser()
    {
        return $this->hasOne(EmployeeUser::class, 'employee_id');
    }
}
    

