<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DepartmentHead;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentHeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DepartmentHead::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'department_id' => \App\Models\Department::factory(),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
