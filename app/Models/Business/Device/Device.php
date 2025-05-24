<?php

namespace App\Models\Business\Device;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Department\Department;
use App\Models\Business\Employee\Employee;
use App\Models\Business\Device\DeviceType\DeviceType;
use App\Models\Business\Device\DeviceBrand\DeviceBrand;
use App\Models\Business\Device\DeviceModel\DeviceModel;

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

    public function deviceType() {
        return $this->belongsTo(DeviceType::class);
    }

    public function deviceBrand() {
        return $this->belongsTo(DeviceBrand::class);
    }

    public function deviceModel() {
        return $this->belongsTo(DeviceModel::class);
    }
}
