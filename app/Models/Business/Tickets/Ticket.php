<?php

namespace App\Models\Business\Tickets;

use App\Models\Business\Employee\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_category_id',
        'title',
        'descreption',
        'opened_at',
        'closed_at',
        'status',
        'attachment_path'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ticketCategory()
    {
        return $this->belongsTo(TicketCategory::class);
    }
}


