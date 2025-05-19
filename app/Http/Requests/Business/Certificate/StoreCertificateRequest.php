<?php

namespace App\Http\Requests\Business\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            
            'employee_id' => 'required',
            'creation_date' => 'required|date',
            'last_renovation' => 'required|date',
            'renewal_date' => 'required|date',
            'status' => 'required|boolean'
        ];
    }
}
