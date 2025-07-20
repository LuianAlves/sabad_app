<?php

namespace App\Models;

use App\Models\Business\Company\Company;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    protected $fillable = ['name', 'current_adjustment_percent'];

    public function adjustments()
    {
        return $this->hasMany(UnionAdjustment::class);
    }

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
