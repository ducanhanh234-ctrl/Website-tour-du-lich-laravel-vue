<?php

namespace Database\Factories;

use App\Models\Tour;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Tour>
 */
class TourFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(4),
            'type' => fake()->randomElement(['domestic', 'international', 'customized']),
            'description' => fake()->paragraph(),
            'slug' => fake()->unique()->slug(),
            'is_active' => true,
        ];
    }
}
