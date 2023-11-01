<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::first();

        return [
            'type' => fake()->randomElement((['single', 'double', 'suite', 'shared'])),
            'total' => fake()->randomNumber(1),
            'hotel_id' => fake()->randomNumber(),
            'user_id' => $user->id,
        ];
    }
}
