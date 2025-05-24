<?php

namespace App\Http\Requests\Business\Device\DeviceModel;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceModelRequest extends FormRequest
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
