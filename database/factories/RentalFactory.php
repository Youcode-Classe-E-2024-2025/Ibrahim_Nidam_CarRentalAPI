<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rental>
 */
class RentalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-1 years', 'now');
        $returnDate = $this->faker->dateTimeBetween($startDate, 'now');

        return [
            'user_id'     => User::factory(),
            'car_id'      => Car::factory(),
            'amount'      => $this->faker->randomFloat(2, 50, 500), // Montant entre 50 et 500
            'start_date' => $startDate,
            'return_date' => $returnDate,
        ];
    }
}
