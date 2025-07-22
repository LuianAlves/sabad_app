<?php

namespace App\Models\Business\Employee;


use App\Models\HierarchicalLevel;
use App\Models\SalaryBand;
use App\Models\TierLevel;
use App\Models\TrainingClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Extension\Extension;
use App\Models\Business\User\EmployeeUser;
use App\Models\Business\Email\Email;
use App\Models\Business\Company\Company;
use App\Models\Business\Department\Department;
use App\Models\Business\Certificate\Certificate;
use App\Models\Business\Device\DeviceControl\DeviceControl;
use App\Models\Business\Heritage\HeritageControl\HeritageControl;

use App\Contracts\Auditable;
use App\Models\Business\Chip\ChipControl\ChipControl;
use App\Models\Business\Task\Task;
use App\Models\Business\Tickets\Ticket;

class Employee extends Model implements Auditable
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'hierarchical_level_id',
        'tier_level_id',
        'salary_band_id',
        'hired_in',
        'fired_in',
        'status'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Funcionário #{$this->id}";
    }

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
        return $this->hasMany(Email::class, 'employee_id');
    }


    public function employeeUser()
    {
        return $this->hasOne(EmployeeUser::class, 'employee_id');
    }

    public function deviceControl()
    {
        return $this->hasOne(DeviceControl::class, 'employee_id'); // ✅ CORRETO
    }



    public function ticket()
    {
        return $this->hasMany(Ticket::class);
    }

    public function task()
    {
        return $this->hasMany(Task::class);
    }

    public function chipControl()
    {
        return $this->hasOne(ChipControl::class);
    }

    public function extension()
    {
        return $this->hasOne(Extension::class, 'employee_id');
    }

    public function trainingClass()
    {
        return $this->hasMany(TrainingClass::class, 'instructor_id', 'id');
    }

    public function hierarchicalLevel()
    {
        return $this->belongsTo(HierarchicalLevel::class);
    }

    public function tierLevel()
    {
        return $this->belongsTo(TierLevel::class);
    }

    public function salaryBand()
    {
        return $this->belongsTo(SalaryBand::class);
    }
}
