<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabin;

class CabinSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 10) as $i) {
            Cabin::create([
                'name' => 'Cabaña ' . fake()->unique()->word(),
                'description' => fake()->sentence(15),
                'capacity' => fake()->numberBetween(2, 10),
                'size_m2' => fake()->numberBetween(30, 120),
                'price_per_night' => fake()->numberBetween(800, 3000),
                'latitude' => fake()->latitude(18.0, 22.0),   // rango de México
                'longitude' => fake()->longitude(-105.0, -95.0),
                'active' => fake()->boolean(85), // 85% probabilidad de que esté activa
            ]);
        }
    }
}
