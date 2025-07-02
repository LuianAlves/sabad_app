<?php

namespace App\Models\Business\Extension;

use App\Models\Business\Email\Email;
use App\Models\Business\User\EmployeeUser;
use App\Models\Business\Employee\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{

    use HasFactory;

    protected $fillable = [
        'employee_id',
        'number',
        'email_id',
        'password',
        'meet'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function employeeUser()
    {
        return $this->belongsTo(EmployeeUser::class, 'employee_id');
    }

    public function email()
    {
        return $this->belongsTo(Email::class, 'email_id');
    }


}
