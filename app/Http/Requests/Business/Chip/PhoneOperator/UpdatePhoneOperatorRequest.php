<?php

namespace App\Http\Requests\Business\Chip\PhoneOperator;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhoneOperatorRequest extends FormRequest
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
            'name' => 'required|string'
        ];
    }
}
