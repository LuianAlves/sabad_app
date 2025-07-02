<?php

namespace App\Models\Business\Chip\ChipControl;

use App\Models\Business\Chip\Chip;
use App\Models\Business\Company\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business\Employee\Employee;

class ChipControl extends Model
{

    use HasFactory;

    protected $fillable = [
        'chip_id',
        'employee_id',
        'ddd',
        'number',
        'delivered_in',
        'returned_in'
    ];

    public function chip()
    {
        return $this->belongsTo(Chip::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
