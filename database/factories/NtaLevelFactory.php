<?php

namespace Database\Factories;

use App\Models\NtaLevel;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class NtaLevelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NtaLevel::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->sentence(7),
        ];
    }
}
