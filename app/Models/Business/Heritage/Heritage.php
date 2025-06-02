<?php

namespace App\Models\Business\Heritage;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Heritage\HeritageType\HeritageType;
use App\Models\Business\Heritage\HeritageBrand\HeritageBrand;
use App\Models\Business\Heritage\HeritageModel\HeritageModel;
use App\Models\Business\Heritage\HeritageControl\HeritageControl;
use App\Models\Business\Department\Department;

class Heritage extends Model implements Auditable
{
     protected $fillable = [
        'heritage_type_id',
        'heritage_brand_id',
        'heritage_model_id'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Patrimônio #{$this->id}";
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }

    public function heritageType() {
        return $this->belongsTo(HeritageType::class);
    }

    public function heritageBrand() {
        return $this->belongsTo(HeritageBrand::class);
    }

    public function heritageModel() {
        return $this->belongsTo(HeritageModel::class);
    }

     public function heritageControl() {
        return $this->hasMany(HeritageControl::class);
    }
}
