<?php

namespace App\Models\Business\Domain;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Contracts\Auditable;

// Models
use App\Models\Business\Company\Company;

class Domain extends Model implements Auditable
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'name',
        'plan_validity',
        'last_payment',
        'next_payment',
        'is_active'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "ID {$this->id}";
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
