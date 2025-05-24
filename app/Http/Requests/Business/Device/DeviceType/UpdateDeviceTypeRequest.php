<?php

namespace App\Http\Requests\Business\Device\DeviceType;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceTypeRequest extends FormRequest
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
