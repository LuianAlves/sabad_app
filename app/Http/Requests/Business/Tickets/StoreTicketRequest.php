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
            'ticketcategory_id' => 'required',
            'title' => 'required|string',
            'descreption' => 'required|max:300',
            'opened_at' => 'nullable',
            'closed_at' => 'nullable',
            'status' => 'nullable',
            'attachment_path' => 'nullable'
        ];
    }
}
