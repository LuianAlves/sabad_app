<?php

namespace App\Models\Business\Device\DeviceModel;

use Illuminate\Database\Eloquent\Model;

use App\Models\Business\Device\DeviceBrand\DeviceBrand;

class DeviceModel extends Model
{
    protected $fillable = [
        'device_brand_id',
        'name'
    ];

    public function deviceBrand() {
        return $this->belongsTo(DeviceBrand::class);
    }
}
