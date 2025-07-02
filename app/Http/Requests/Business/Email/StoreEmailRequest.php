<?php

namespace App\Http\Requests\Business\Email;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmailRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'employee_id' => 'required',
            'license_id' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alias' => 'required',
            'is_active' => 'required'

        ];
    }
}
