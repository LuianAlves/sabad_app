<?php

namespace App\Models\Business\Heritage\HeritageModel;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

use App\Models\Business\Heritage\HeritageBrand\HeritageBrand;
use App\Models\Business\Heritage\Heritage;

class HeritageModel extends Model implements Auditable
{
    protected $fillable = [
        'heritage_brand_id',
        'name'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Modelo de dispositivo #{$this->id}";
    }

    public function heritageBrand() {
        return $this->belongsTo(HeritageBrand::class);
    }

    public function heritages() {
        return $this->hasMany(Heritage::class);
    }
}
