<?php

namespace Database\Factories;

use App\Models\Lecture;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LectureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lecture::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => '1',
            'department_id' => \App\Models\Department::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
