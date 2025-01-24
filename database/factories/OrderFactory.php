<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product' => fake()->word(),
            'amount' => fake()->numberBetween(1, 100), // Cantidad aleatoria entre 1 y 100
            'total' => fake()->randomFloat(2, 1, 1000),
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
