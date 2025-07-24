<?php

namespace App\Http\Requests\Business\Heritage;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHeritageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
            return [
                'heritage_type_id' => 'required|exists:heritage_types,id',
                'heritage_brand_id' => 'required|exists:heritage_brands,id',
                'heritage_model_id' => 'required|exists:heritage_models,id',
            ];

    }
}
