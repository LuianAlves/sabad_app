<?php

namespace App\Models\Business\Heritage\HeritageControl;

use App\Models\Business\Maintenance\Maintenance;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\Business\Heritage\Heritage;
use App\Models\Business\Department\Department;

class HeritageControl extends Model implements Auditable
{
    protected $fillable = [
        'heritage_id',
        'department_id',
        'heritage_code',
        'delivered_in',
        'returned_in',
        'estimated_price',
        'purchased_in'
    ];

    public function getDisplayName(): string
    {
        return $this->name ?? "Dispositivo #{$this->id}";
    }

    public function maintenance()
    {
        return $this->hasMany(Maintenance::class);
    }

    public function heritage() {
        return $this->belongsTo(Heritage::class);
    }

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
