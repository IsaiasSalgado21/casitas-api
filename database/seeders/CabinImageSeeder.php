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
                    'url' => 'https://picsum.photos/seed/' . rand(100, 999) . '/600/400',
                    'description' => fake()->sentence(5),
                ]);
            }
        }
    }
}
