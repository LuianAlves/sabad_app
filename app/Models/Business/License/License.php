<?php

namespace App\Models\Business\License;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Service\Service;

class License extends Model
{
    /** @use HasFactory<\Database\Factories\Business\License\LicenseFactory> */
    use HasFactory;

    protected $fillable = [
        'service_id',
        'name',
        'description',
        'quantity',
        'user',
        'email',
        'password',
        'contracted_in',
        'price_per_unit',
        'recurrence',
        'payment_day',
        'is_active',
    ];


    public function service() {
        return $this->belongsTo(Service::class);
    }
}
