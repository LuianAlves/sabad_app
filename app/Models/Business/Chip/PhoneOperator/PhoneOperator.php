<?php

namespace App\Models\Business\Chip\PhoneOperator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business\Chip\Chip;

class PhoneOperator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function chip(){

        return $this->hasMany(Chip::class);
    }
}
