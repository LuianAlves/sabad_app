<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'task_status_id' => 'required|exists:task_statuses,task_status_id',
            'responsible' => 'required|exists:users,id',
            'due_date' => 'nullable|date',
        ];
    }
}
