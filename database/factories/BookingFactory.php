<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\TourVersion;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'tour_version_id' => TourVersion::factory(),
            'status' => fake()->randomElement(['pending', 'deposited', 'completed']),
            'total_guests' => fake()->numberBetween(1, 10),
            'total_price' => fake()->randomFloat(2, 1000000, 50000000),
        ];
    }
}
