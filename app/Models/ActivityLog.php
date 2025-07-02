<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// Models
use App\Models\User;

class ActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'model_type',
        'model_id',
        'action',
        'description',
        'diff'
    ];

    protected $casts = [
        'diff' => 'json',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
