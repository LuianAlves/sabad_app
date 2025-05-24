<?php

namespace App\Models\Business\Device;

use App\Models\Business\Department\Department;
use App\Models\Business\Employee\Employee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'device_type_id',
        'device_brand_id',
        'device_model_id'
    ];

    public function department() {

        return $this->belongsTo(Department::class);

    }
    public function employee() {

        return $this->belongsTo(Employee::class);

    }
}
