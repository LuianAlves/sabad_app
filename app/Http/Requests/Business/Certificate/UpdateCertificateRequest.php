<?php

namespace App\Http\Requests\Business\Certificate;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
