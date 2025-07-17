<?php

namespace App\Models;

use App\Models\Business\Department\Department;
use App\Models\Business\Employee\Employee;
use Illuminate\Database\Eloquent\Model;

class RecordControl extends Model
{
    protected $fillable = [
        'department_id',
        'employee_id',
        'identificacao',
        'forma_armazenamento',
        'local_armazenamento',
        'acesso_permitido',
        'tempo_retencao',
        'metodo_manutencao',
    ];

    // Relacionamento com Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Relacionamento com Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}

