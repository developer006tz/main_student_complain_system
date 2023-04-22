<?php

namespace Database\Factories;

use App\Models\Enrollment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EnrollmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Enrollment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'student_id' => \App\Models\Student::factory(),
            'course_id' => \App\Models\Course::factory(),
            'semester_id' => \App\Models\Semester::factory(),
            'academic_year_id' => \App\Models\AcademicYear::factory(),
        ];
    }
}
