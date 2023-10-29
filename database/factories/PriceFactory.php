<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
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
            'date' => fake()->dateTimeBetween('2 days', '3 months')->format('Y-m-d'),
            'value' => fake()->randomFloat(2, 30, 200),
            'room_id' => fake()->randomNumber(),
            'user_id' => $user->id,
        ];
    }
}
