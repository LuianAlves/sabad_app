<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order' => 'sometimes|integer|min:0',
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
            'due_date' => 'sometimes|nullable|date',
            'priority' => 'sometimes|required|in:low,medium,high,important',
            'responsible' => 'sometimes|required|array',
            'responsible.*' => 'exists:users,id',
            'task_status_id' => 'sometimes|required|exists:task_statuses,task_status_id',
            'tags' => 'nullable|array',
            'checklist' => 'nullable|array',
            'quick_notes' => 'nullable|string',
        ];
    }
}
