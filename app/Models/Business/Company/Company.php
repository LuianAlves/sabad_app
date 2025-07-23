<?php

namespace App\Models\Business\Company;

use App\Contracts\Auditable;
use App\Models\Business\Chip\Chip;
use App\Models\Business\Room\Room;
use App\Models\HierarchicalLevel;
use App\Models\Union;
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
        'union_id',
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

    public function rooms()
    {
        return $this->hasMany(Room::class);
    }

    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    public function hierarchicalLevels()
    {
        return $this->hasMany(HierarchicalLevel::class, 'company_id');
    }


}
