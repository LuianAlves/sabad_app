<?php

namespace App\Models\Business\Tickets;

use App\Models\Business\Employee\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(Employee::class);
    }

    public function ticketCategory()
    {
        return $this->hasMany(TicketCategory::class);
    }
}


