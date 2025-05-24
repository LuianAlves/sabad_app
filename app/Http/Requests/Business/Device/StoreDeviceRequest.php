<?php

namespace App\Http\Requests\Business\Device;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'department_id' => 'required',
            'device_type' => 'required|in:0,1,2,3,4',
            'brand' => 'required|string|max:20',
            'model' => 'required|string|max:20',
        ];
    }
}
