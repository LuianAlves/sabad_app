<?php

namespace App\Http\Requests\Business\Domain;

use Illuminate\Foundation\Http\FormRequest;

class StoreDomainRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'company_id'     => 'required|exists:companies,id',
            'name'           => 'required|string|max:70',
            'plan_validity'  => 'required|date',
            'last_payment'   => 'nullable|date',
            'next_payment'   => 'nullable|date',
            'is_active'      => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'company_id.required' => 'O campo empresa é obrigatório',
            'name.requires' => 'O campo nome é obrigatório',
            'plan_validity.required' => 'O campo validade é obrigatório', 
            'last_payment.date' => 'O campo deve ser uma data válida',
            'next_payment.date' => 'O campo deve ser uma data válida',
            'is_active.required' => 'O status é obrigatório'
        ];
    }
}
