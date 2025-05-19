<?php

namespace App\Models\Business\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Business\Department\Department;

class Service extends Model
{
    /** @use HasFactory<\Database\Factories\Business\Service\ServiceFactory> */
    use HasFactory;

    protected $fillable = [
        'department_id',
        'name',
        'description',
        'url',
        'user',
        'email',
        'password',
        'contracted_in',
        'price',
        'recurrence',
        'payment_day',
        'is_active',
    ];

    public function department() {
        return $this->belongsTo(Department::class);
    }
}
