<?php

namespace App\Models\Business\Certificate;

use App\Contracts\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Business\Company\Company;
use App\Models\Business\Employee\Employee;

class Certificate extends Model implements Auditable
{
    use HasFactory;

    protected $fillable = [
        
        'employee_id',
        'creation_date',
        'last_renovation',
        'renewal_date',
        'status'
    ];

    public function getDisplayName(): string
    {
        return $this->creation_date ?? "Certificado #{$this->id}";
    }

    public function employee() {

        return $this->belongsTo(Employee::class);

    }

}
