<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'task_status_id' => 'sometimes|required|exists:task_statuses,task_status_id',
            'responsible' => 'sometimes|required|exists:users,id',
            'due_date' => 'nullable|date',
        ];
    }
}
