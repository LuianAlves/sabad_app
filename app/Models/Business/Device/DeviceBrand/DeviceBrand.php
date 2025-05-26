<?php

namespace App\Models\Business\Device\DeviceBrand;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Device\Device;
use App\Models\Business\Device\DeviceModel\DeviceModel;

class DeviceBrand extends Model implements Auditable
{
    protected $fillable = [
        'name'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Marca de dispositivo #{$this->id}";
    }

    public function devices() {
        return $this->hasMany(Device::class);
    }

    public function deviceModels() {
        return $this->hasMany(DeviceModel::class);
    }
}
