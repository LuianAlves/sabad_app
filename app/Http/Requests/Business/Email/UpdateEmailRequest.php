<?php

namespace App\Http\Requests\Business\Email;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
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
            'license_id' => 'required',
            'email' => 'required',
            'password' => 'required',
            'alias' => 'required',
            'is_active' => 'required'

        ];
    }
}
