<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Student::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gender' => 'male',
            'date_of_birth' => $this->faker->date,
            'admission_id' => $this->faker->text(255),
            'maritial_status' => 'single',
            'status' => '1',
            'department_id' => \App\Models\Department::factory(),
            'program_id' => \App\Models\Program::factory(),
            'user_id' => \App\Models\User::factory(),
            'country_id' => \App\Models\Country::factory(),
        ];
    }
}
