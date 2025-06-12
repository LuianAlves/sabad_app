<?php

namespace App\Http\Requests\Business\Chip\ChipControl;

use Illuminate\Foundation\Http\FormRequest;

class StoreChipControlRequest extends FormRequest
{
   
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
