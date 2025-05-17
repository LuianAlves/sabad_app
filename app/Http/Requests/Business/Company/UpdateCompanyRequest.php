<?php

namespace App\Http\Requests\Business\Company;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:70',
            'cnpj' => 'required|string|max:20'
            ];
    }

    public function messages()
    {
        return [
            'name_required' => 'O nome da empresa é obrigatório',
            'cnpj_required' => 'O cnpj da empresa é obrigatório'
        ];
    }
}
