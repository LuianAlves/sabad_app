<?php

namespace App\Models\Business\Room;

use App\Models\Business\Booking\booking;
use app\Models\Business\Company\Company;
use App\Models\Business\Training\TrainingClass;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    use HasFactory;

    protected $fillable = [
        'company_id',
        'name'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function trainingClass()
    {
        return $this->hasMany(TrainingClass::class);
    }
}
