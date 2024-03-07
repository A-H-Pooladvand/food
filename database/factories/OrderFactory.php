<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\=Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Random\RandomException
     */
    public function definition(): array
    {
        return [
            'delivery_time' => now()->subMinutes(random_int(0, 60)), // Just to fake delayed orders
            'created_at'    => now()
        ];
    }
}
