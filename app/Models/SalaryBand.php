<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalaryBand extends Model
{
    protected $fillable = [
        'hierarchical_level_id',
        'band',
        'salary',
    ];

    public function hierarchicalLevel()
    {
        return $this->belongsTo(HierarchicalLevel::class);
    }

    public function tierLevel()
    {
        return $this->belongsTo(TierLevel::class);
    }
}
