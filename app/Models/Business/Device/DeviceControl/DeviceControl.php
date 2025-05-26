<?php

namespace App\Models\Business\Device\DeviceControl;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

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
}
