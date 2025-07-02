<?php

namespace App\Http\Requests\Business\Chip\PhoneOperator;

use Illuminate\Foundation\Http\FormRequest;

class StorePhoneOperatorRequest extends FormRequest
{
    
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
