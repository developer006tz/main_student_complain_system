<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->text(255),
            'name' => $this->faker->name(),
            'credit' => $this->faker->randomNumber(1),
            'elective' => '1',
            'department_id' => \App\Models\Department::factory(),
            'nta_level_id' => \App\Models\NtaLevel::factory(),
            'program_id' => \App\Models\Program::factory(),
            'semester_id' => \App\Models\Semester::factory(),
        ];
    }
}
