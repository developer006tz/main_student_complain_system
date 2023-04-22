<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseStoreRequest extends FormRequest
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
            'credit' => ['required', 'numeric'],
            'elective' => ['required', 'in:0,1'],
            'semester_id' => ['nullable', 'exists:semesters,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'nta_level_id' => ['required', 'exists:nta_levels,id'],
            'program_id' => ['required', 'exists:programs,id'],
        ];
    }
}
