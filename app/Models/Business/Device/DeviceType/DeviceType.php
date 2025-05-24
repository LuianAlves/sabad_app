<?php

namespace App\Models\Business\Device\DeviceType;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Device\Device;

class DeviceType extends Model
{
    protected $fillable = [
        'name'
    ];

    public function devices() {
        return $this->hasMany(Device::class, 'device_type_id');
    }
}
