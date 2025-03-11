<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Payment;
use App\Models\Rental;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        // Crée des voitures
        Car::factory(15)->create();

        // Crée des locations
        Rental::factory(20)->create();
    }
}
