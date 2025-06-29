<?php

namespace App\Models\Business\Company;

use App\Contracts\Auditable;
use App\Models\Business\Chip\Chip;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business\Chip\PhoneOperator\PhoneOperator;
use App\Models\Business\Department\Department;
use App\Models\Business\Employee\Employee;

class Company extends Model implements Auditable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Empresa #{$this->id}";
    }

    public function departments() {
        return $this->hasMany(Department::class);
    }

    public function employees() {
        return $this->belongsTo(Employee::class);
    }

    public function chip()
    {
        return $this->hasMany(Chip::class);
    }

    public function phone_operators() 
    {
        return $this->hasMany(PhoneOperator::class);
    }
}
