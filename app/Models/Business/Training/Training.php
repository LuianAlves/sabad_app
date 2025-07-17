<?php

namespace App\Models\Business\Training;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $fillable = [
        'title',
        'description'
    ];

    public function trainingClass() {
        return $this->hasMany(TrainingClass::class);
    }
}
