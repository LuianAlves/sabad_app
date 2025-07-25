<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'order' => 'required|integer|min:0',
            'task_status_id' => 'required|exists:task_statuses,task_status_id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'priority' => 'required|in:low,medium,high,important',
            'responsible' => 'required|array',
            'responsible.*' => 'exists:users,id',
            'tags' => 'nullable|array',
            'checklist' => 'nullable|array',
            'quick_notes' => 'nullable|string',
        ];
    }
}
