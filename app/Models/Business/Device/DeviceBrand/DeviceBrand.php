<?php

namespace App\Models\Business\Device\DeviceBrand;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Device\Device;
use App\Models\Business\Device\DeviceModel\DeviceModel;

class DeviceBrand extends Model
{
    protected $fillable = [
        'name'
    ];

    public function devices() {
        return $this->hasMany(Device::class);
    }

    public function deviceModels() {
        return $this->hasMany(DeviceModel::class);
    }
}
