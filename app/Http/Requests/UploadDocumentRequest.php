<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UploadDocumentRequest extends FormRequest
{
    public function authorize() {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|file|max:10240', // até 10MB
        ];
    }
}
