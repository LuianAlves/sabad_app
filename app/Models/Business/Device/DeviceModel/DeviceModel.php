<?php

namespace App\Models\Business\Device\DeviceModel;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

use App\Models\Business\Device\DeviceBrand\DeviceBrand;
use App\Models\Business\Device\Device;

class DeviceModel extends Model implements Auditable
{
    protected $fillable = [
        'device_brand_id',
        'name'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Modelo de dispositivo #{$this->id}";
    }

    public function deviceBrand() {
        return $this->belongsTo(DeviceBrand::class);
    }

    public function devices() {
        return $this->hasMany(Device::class);
    }
}
