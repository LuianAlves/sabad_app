<?php

namespace App\Models\Business\Domain;

use App\Models\Business\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
