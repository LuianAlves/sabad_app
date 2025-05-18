<?php

namespace App\Models\Business\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Business\Department\Department;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cnpj'
    ];

    public function departments() {
        return $this->hasMany(Department::class);
    }
}
