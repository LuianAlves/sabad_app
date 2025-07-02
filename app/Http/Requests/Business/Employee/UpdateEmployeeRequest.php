<?php

namespace App\Http\Requests\Business\Employee;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'department_id' => 'required',
            'name' => 'required|string|max:70',
            'hierarchical_level' => 'required|string',
            'hired_in' => 'required|date',
            'fired_in' => 'nullable|date',
            'status' => 'required|boolean'
        ];
    }
}
