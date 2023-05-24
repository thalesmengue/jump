<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceOrder>
 */
class ServiceOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->numberBetween(1, 10),
            'vehiclePlate' => $this->faker->randomElement(['ABC1234', 'DEF5678', 'GHI9012']),
            'entryDateTime' => $this->faker->dateTimeBetween('-1 year'),
            'exitDateTime' => $this->faker->dateTimeBetween('-1 year'),
            'priceType' => 'money',
            'price' => $this->faker->randomFloat(2, 1, 1000),
        ];
    }
}
