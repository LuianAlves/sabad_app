<?php

namespace App\Models;

use App\Models\Business\Company\Company;
use Illuminate\Database\Eloquent\Model;

class HierarchicalLevel extends Model
{
    protected $fillable = [
        'company_id',
        'name',
        'order',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tierLevels()
    {
        return $this->hasMany(TierLevel::class);
    }

}
