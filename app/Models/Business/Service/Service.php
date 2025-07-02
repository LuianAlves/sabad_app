<?php

namespace App\Models\Business\Service;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Department\Department;
use App\Models\Business\License\License;

class Service extends Model implements Auditable
{
    /** @use HasFactory<\Database\Factories\Business\Service\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'description',
        'url',
        'user',
        'email',
        'password',
        'contracted_in',
        'price',
        'recurrence',
        'payment_day',
        'is_active',
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Serviço #{$this->id}";
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function licenses() {
        return $this->hasMany(License::class);
    }
}
