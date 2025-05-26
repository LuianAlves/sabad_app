<?php

namespace App\Models\Business\Maintenance;

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

    public function devicecontrol()
    {
        return $this->belongsTo(DeviceControl::class);
    }
}
