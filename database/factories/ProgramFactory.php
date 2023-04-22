<?php

namespace Database\Factories;

use App\Models\Program;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Program::class;

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
            'capacity' => $this->faker->randomNumber(0),
            'department_id' => \App\Models\Department::factory(),
            'nta_level_id' => \App\Models\NtaLevel::factory(),
        ];
    }
}
