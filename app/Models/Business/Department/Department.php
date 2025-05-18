<?php

namespace App\Models\Business\Department;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business\Employee\Employee;
use App\Models\Business\Company\Company;

class Department extends Model
{
    use HasFactory;

    protected $fillable =[
        'company_id',
        'name'
    ];

    public function company() 
    {
        return $this->belongsTo(Company::class);
    }

    public function employee() 
    {
        return $this->belongsTo(Employee::class);
    }
}
