<?php

namespace App\Http\Requests\Business\Maintenance;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaintenanceRequest extends FormRequest
{
   
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'device_control_id' => 'required',
            'delivered_in' => 'required|date',
            'last_maintenance' => 'nullable|date',
            'next_maintenance' => 'nullable|date' 
        ];
    }
}
