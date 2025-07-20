<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TierLevel extends Model
{
    protected $fillable = [
        'hierarchical_level_id',
        'name',
        'order',
    ];

    public function hierarchicalLevel()
    {
        return $this->belongsTo(HierarchicalLevel::class);
    }

    public function salaryBands()
    {
        return $this->hasMany(SalaryBand::class, 'tier_level_id');
    }
}
