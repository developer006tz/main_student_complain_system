<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintStoreRequest extends FormRequest
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
            'complain_type_id' => ['required', 'exists:complain_types,id'],
            'student_id' => ['required', 'exists:students,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'program_id' => ['nullable', 'exists:programs,id'],
            'course_id' => ['nullable', 'exists:courses,id'],
            'lecture_id' => ['nullable', 'exists:lectures,id'],
            'semester_id' => ['nullable', 'exists:semesters,id'],
            'academic_year_id' => ['nullable', 'exists:academic_years,id'],
            'description' => ['required', 'max:65530', 'string'],
            'solution' => ['required', 'max:65530', 'string'],
            'date' => ['required', 'date'],
        ];
    }
}
