<?php

namespace App\Models\Business\Device\DeviceControl;

use App\Models\Business\Maintenance\Maintenance;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Device\Device;
use App\Models\Business\Employee\Employee;

class DeviceControl extends Model implements Auditable
{
    protected $fillable = [
        'device_id',
        'employee_id',
        'device_code',
        'delivered_in',
        'returned_in',
        'estimated_price',
        'purchased_in'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Dispositivo #{$this->id}";
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function device() {
        return $this->belongsTo(Device::class);
    }

    public function employee() {
        return $this->belongsTo(Employee::class);
    }
}
