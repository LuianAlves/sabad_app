<?php

namespace App\Http\Requests\Business\Device\DeviceType;

use Illuminate\Foundation\Http\FormRequest;

class StoreDeviceTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //
        ];
    }
}
