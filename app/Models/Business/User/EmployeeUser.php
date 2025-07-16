<?php

namespace App\Models\Business\User;

use App\Models\Business\Booking\Booking;
use App\Models\Business\Employee\Employee;
use App\Models\Business\Extension\Extension;
use App\Models\Business\Tickets\Ticket;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class EmployeeUser extends Model
{
    protected $fillable = [
        'employee_id',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'employee_id');
    }

    public function extension()
    {
        return $this->belongsTo(Extension::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
