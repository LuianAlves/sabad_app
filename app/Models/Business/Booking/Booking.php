<?php

namespace App\Models\Business\Booking;

use App\Models\Business\Room\Room;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'room_id',
        'title',
        'description',
        'start_time',
        'end_time',
    ];

    protected $dates = [
        'start_time',
        'end_time',
    ];

    /**
     * O usuário que criou o agendamento
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * A sala que foi reservada
     */
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}

