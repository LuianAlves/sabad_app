<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskStatusRequest extends FormRequest
{
    public function authorize()
    {
        return true; // ajuste se usar policies/middleware
    }

    public function rules()
    {
        return [
            'name'  => 'required|string|max:255',
            'color' => ['required','string','regex:/^#[A-Fa-f0-9]{6}$/'],
        ];
    }
}
