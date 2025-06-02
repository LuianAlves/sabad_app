<?php

namespace App\Models\Business\Heritage\HeritageType;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

use App\Models\Business\Heritage\Heritage;

class HeritageType extends Model implements Auditable
{
        protected $fillable = [
        'name'
    ];

    public function heritages() {
        return $this->hasMany(Heritage::class, 'heritage_type_id');
    }

    public function getDisplayName(): string
    {
        return $this->name ?? "Tipo de dispositivo #{$this->id}";
    }
}
