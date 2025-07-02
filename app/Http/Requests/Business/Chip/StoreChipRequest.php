<?php

namespace App\Http\Requests\Business\Chip;

use Illuminate\Foundation\Http\FormRequest;

class StoreChipRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'company_id' => 'required',
            'phone_operator_id' => 'required'
        ];
    }
}
