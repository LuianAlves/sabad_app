<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'  => 'sometimes|required|string|max:255',
            'order' => 'sometimes|required|integer|min:0',
            'color' => ['sometimes','required','string','regex:/^#[A-Fa-f0-9]{6}$/'],
        ];
    }
}
