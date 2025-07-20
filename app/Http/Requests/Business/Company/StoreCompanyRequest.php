<?php

namespace App\Http\Requests\Business\Company;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required',
            'cpfCnpj' => 'required',
            'union_id' => 'nullable|exists:unions,id'
            ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome da empresa é obrigatório',
            'cpfCnpj.required' => 'O cnpj da empresa é obrigatório'
        ];
    }
}

