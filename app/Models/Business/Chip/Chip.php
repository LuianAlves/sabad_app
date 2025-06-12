<?php

namespace App\Models\Business\Chip;

use App\Models\Business\Chip\ChipControl\ChipControl;
use App\Models\Business\Chip\PhoneOperator\PhoneOperator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business\Company\Company;


class Chip extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'phone_operator_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function phone_operator()
    {
        return $this->belongsTo(PhoneOperator::class);
    }

    public function chipControl()
    {
        return $this->belongsTo(ChipControl::class);
    }
}
