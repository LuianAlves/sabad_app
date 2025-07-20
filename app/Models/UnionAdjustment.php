<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnionAdjustment extends Model
{
    protected $table = 'union_adjustments';

    protected $fillable = [
        'union_id',
        'year',
        'percent',
    ];

    // Relação inversa
    public function union()
    {
        return $this->belongsTo(Union::class);
    }
}
