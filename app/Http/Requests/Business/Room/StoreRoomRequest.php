<?php

namespace App\Http\Requests\Business\Room;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoomRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'company_id' => 'required',
            'name' => 'required|string|max:255',
        ];
    }
}
