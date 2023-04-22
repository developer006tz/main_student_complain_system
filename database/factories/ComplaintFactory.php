<?php

namespace Database\Factories;

use App\Models\Complaint;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComplaintFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Complaint::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence(15),
            'solution' => $this->faker->text,
            'date' => $this->faker->date,
            'status' => '0',
            'complain_type_id' => \App\Models\ComplainType::factory(),
            'student_id' => \App\Models\Student::factory(),
            'department_id' => \App\Models\Department::factory(),
            'program_id' => \App\Models\Program::factory(),
            'course_id' => \App\Models\Course::factory(),
            'lecture_id' => \App\Models\Lecture::factory(),
            'semester_id' => \App\Models\Semester::factory(),
            'academic_year_id' => \App\Models\AcademicYear::factory(),
        ];
    }
}
