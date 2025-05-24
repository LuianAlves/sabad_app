<?php

namespace App\Http\Requests\Business\Device\DeviceBrand;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDeviceBrandRequest extends FormRequest
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
