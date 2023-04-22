<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LectureStoreRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'image' => ['nullable', 'image', 'max:1024'],
            'status' => ['required', 'in:1,0'],
        ];
    }
}
