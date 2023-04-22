<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MessageUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'body' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            'phone' => ['nullable', 'max:255', 'string'],
            'send_status' => ['nullable', 'in:0,1,2,3,4'],
            'type' => ['nullable', 'in:0,1'],
        ];
    }
}
