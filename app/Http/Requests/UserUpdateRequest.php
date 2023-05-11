<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'name' => ['required', 'max:255', 'string'],
            'email' => [
                'required',
                Rule::unique('users', 'email')->ignore($this->user),
                'email',
            ],
            'phone' => [
                'required',
                Rule::unique('users', 'phone')->ignore($this->user),
                'max:255',
                'string',
            ],
            // 'designation' => ['required', 'in:student,lecture'],
            'password' => ['nullable'],
            'roles' => 'array',
        ];
    }
}
