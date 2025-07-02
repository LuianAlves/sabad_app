<?php

namespace App\Models\Collaborator;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Business\User\EmployeeUser;

class Collaborator extends Model
{
    
    use HasFactory;


    public function user()
    {
        return $this->belongsTo(EmployeeUser::class);
    }
}
