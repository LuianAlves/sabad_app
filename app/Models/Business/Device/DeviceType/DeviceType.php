<?php

namespace App\Models\Business\Device\DeviceType;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Device\Device;

class DeviceType extends Model implements Auditable
{
    protected $fillable = [
        'name'
    ];

    public function devices() {
        return $this->hasMany(Device::class, 'device_type_id');
    }

    public function getDisplayName(): string
    {
        return $this->name ?? "Tipo de dispositivo #{$this->id}";
    }
}
