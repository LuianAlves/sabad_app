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
            'device_type_id' => 'required',
            'device_brand_id' => 'required',
            'device_model_id' => 'required'
        ];
    }
}
