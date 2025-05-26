<?php

namespace App\Models\Business\Department;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Employee\Employee;
use App\Models\Business\Company\Company;
use App\Models\Business\Service\Service;
use App\Models\Business\Device\Device;

class Department extends Model implements Auditable
{
    use HasFactory;

    protected $fillable =[
        'company_id',
        'name'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Departamento #{$this->id}";
    }

    public function company() 
    {
        return $this->belongsTo(Company::class);
    }

    public function employees() 
    {
        return $this->hasMany(Employee::class);
    }

    public function services() {
        return $this->hasMany(Service::class);
    }

    public function device() {
        return $this->belongsTo(Device::class);
    }

}
