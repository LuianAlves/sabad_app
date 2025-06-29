<?php

namespace App\Http\Requests\Business\Department;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
        public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'company_id' => 'required',
            'name' => 'required|string|max:20'
        ];
    }

    public function messages()
    {
        return [
            'company_id' => 'O campo empresa é obrigatório',
            'name' => 'O campo nome é obrigatório'
        ];
    }
}
