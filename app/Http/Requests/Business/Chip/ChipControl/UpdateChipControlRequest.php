<?php

namespace App\Http\Requests\Business\Chip\ChipControl;

use Illuminate\Foundation\Http\FormRequest;

class UpdateChipControlRequest extends FormRequest
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
            'chip_id' => 'required',
            'employee_id' => 'required',
            'ddd'=> 'nullable',
            'number' => 'required',
            'delivered_in' => 'nullable',
            'returned_in' => 'nullable'
        ];
    }
}
