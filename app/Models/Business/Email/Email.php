<?php

namespace App\Models\Business\Email;

use App\Contracts\Auditable;
use App\Models\Business\Employee\Employee;
use App\Models\Business\License\License;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model implements Auditable
{
    
    use HasFactory;

    protected $fillable = [
            'employee_id',
            'license_id',
            'email',
            'password',
            'alias',
            'is_active'

    ];

    public function getDisplayName(): string
    {
        return $this->email ?? "E-mail #{$this->id}";
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}
