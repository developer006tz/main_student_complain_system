<?php

namespace Database\Factories;

use App\Models\Message;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'body' => $this->faker->text(),
            'phone' => $this->faker->phoneNumber(),
            'send_status' => '0',
            'type' => '1',
            'user_id' => \App\Models\User::factory(),
            'sender_id' => \App\Models\User::factory(),
        ];
    }
}
