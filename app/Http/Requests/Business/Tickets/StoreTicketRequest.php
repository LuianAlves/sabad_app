<?php

namespace App\Http\Requests\Business\Tickets;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return true;
    }

    
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'ticket_category_id' => 'required',
            'title' => 'required|string',
            'descreption' => 'required',
            'opened_at' => 'nullable',
            'closed_at' => 'nullable',
            'status' => 'nullable|in:open,in_progress,completed,canceled',
            'attachment_path' => 'nullable'
        ];
    }
}
