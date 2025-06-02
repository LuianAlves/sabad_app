<?php

namespace App\Models\Business\Heritage\HeritageBrand;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Heritage\Heritage;
use App\Models\Business\Heritage\HeritageModel\HeritageModel;

class HeritageBrand extends Model implements Auditable
{
    protected $fillable = [
        'name'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Marca de dispositivo #{$this->id}";
    }

    public function heritages() {
        return $this->hasMany(Heritage::class);
    }

    public function heritageModels() {
        return $this->hasMany(HeritageModel::class);
    }
}
