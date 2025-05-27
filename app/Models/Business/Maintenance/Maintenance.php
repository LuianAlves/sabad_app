<?php

namespace App\Models\Business\Maintenance;

use App\Models\Business\Device\Device;
use App\Models\Business\Device\DeviceControl\DeviceControl;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_control_id',
        'delivered_in',
        'last_maintenance',
        'next_maintenance'
    ];

    public function deviceControl()
    {
        return $this->belongsTo(DeviceControl::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
