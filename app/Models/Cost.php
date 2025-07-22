<?php

// app/Models/Cost.php
namespace App\Models;

use App\Models\Business\Device\DeviceControl\DeviceControl;
use App\Models\Business\Heritage\HeritageControl\HeritageControl;
use App\Models\Business\Service\Service;
use Illuminate\Database\Eloquent\Model;

class Cost extends Model
{
    protected $fillable = [
        'service_id',
        'device_control_id',
        'heritage_control_id',
        'salary_band_id',
        'total',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function deviceControl()
    {
        return $this->belongsTo(DeviceControl::class);
    }

    public function heritageControl()
    {
        return $this->belongsTo(HeritageControl::class);
    }

    public function salaryBand()
    {
        return $this->belongsTo(SalaryBand::class);
    }
}

