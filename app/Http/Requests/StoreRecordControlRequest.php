<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRecordControlRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'identificacao' => 'required|string|max:255',
            'forma_armazenamento' => 'required|string|max:255',
            'local_armazenamento' => 'required|string|max:255',
            'acesso_permitido' => 'required|string|max:255',
            'tempo_retencao' => 'required|string|max:255',
            'metodo_manutencao' => 'required|string|max:255',
        ];
    }

}
