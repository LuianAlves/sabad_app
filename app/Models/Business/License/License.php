<?php

namespace App\Models\Business\License;

use App\Contracts\Auditable;
use App\Models\Business\Email\Email;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Service\Service;

class License extends Model implements Auditable
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

    public function getDisplayName(): string
    {
        return $this->name ?? "Licença #{$this->id}";
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function email()
    {
        return $this->belongsTo(Email::class);
    }
}
