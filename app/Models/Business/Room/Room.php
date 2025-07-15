<?php

namespace App\Models\Business\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Business\Company\Company;

class Room extends Model
{

    use HasFactory;

    protected $fillable =[
        'company_id',
        'name'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
