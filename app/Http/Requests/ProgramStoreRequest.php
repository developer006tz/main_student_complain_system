<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProgramStoreRequest extends FormRequest
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
            'code' => ['required', 'max:255', 'string'],
            'name' => ['required', 'max:255', 'string'],
            'capacity' => ['required', 'numeric'],
            'nta_level_id' => ['required', 'exists:nta_levels,id'],
            'department_id' => ['required', 'exists:departments,id'],
        ];
    }
}
