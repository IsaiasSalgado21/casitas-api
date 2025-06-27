<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cabin;
use App\Models\CabinImage;

class CabinImageSeeder extends Seeder
{
    public function run(): void
    {
        $cabins = Cabin::all();

        foreach ($cabins as $cabin) {
            for ($i = 0; $i < 3; $i++) {
                CabinImage::create([
                    'cabin_id' => $cabin->id,
                    'url' => 'https://i.ibb.co/sv7MR8xV/Whats-App-Image-2025-06-27-at-1-37-05-AM-2.jpg',
                    'description' => fake()->sentence(5),
                ]);
            }
        }
    }
}
