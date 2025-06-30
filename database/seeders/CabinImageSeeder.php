<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CabinImage;

class CabinImageSeeder extends Seeder
{
    public function run(): void
    {
        $images = [
            1 => [
                'https://i.ibb.co/RkKN1c5m/Whats-App-Image-2025-06-27-at-1-37-05-AM.jpg',
                'https://i.ibb.co/678WJzXP/Whats-App-Image-2025-06-27-at-1-37-05-AM-1.jpg',
                'https://i.ibb.co/sv7MR8xV/Whats-App-Image-2025-06-27-at-1-37-05-AM-2.jpg',
                'https://i.ibb.co/cSTnPyw6/Whats-App-Image-2025-06-27-at-1-37-04-AM.jpg',
                'https://i.ibb.co/7JDkLMM7/Whats-App-Image-2025-06-27-at-1-37-04-AM-1.jpg',
            ],
            2 => [
                'https://i.ibb.co/m5Lv5Q7c/Whats-App-Image-2025-06-27-at-1-37-04-AM-4.jpg',
                'https://i.ibb.co/DfyDn4d5/Whats-App-Image-2025-06-27-at-1-37-04-AM-3.jpg',
                'https://i.ibb.co/2zkkFCq/Whats-App-Image-2025-06-27-at-1-37-04-AM-2.jpg',
            ],
            3 => [
                'https://i.ibb.co/qFD1RXXD/Whats-App-Image-2025-06-27-at-1-37-03-AM.jpg',
                'https://i.ibb.co/JjF6hJ2X/Whats-App-Image-2025-06-27-at-1-37-03-AM-1.jpg',
                'https://i.ibb.co/tpysr96M/Whats-App-Image-2025-06-27-at-1-37-03-AM-2.jpg',
                'https://i.ibb.co/cXC0y4Nb/Whats-App-Image-2025-06-27-at-1-37-03-AM-3.jpg',
                'https://i.ibb.co/rGfd4HSQ/Whats-App-Image-2025-06-27-at-1-37-02-AM.jpg',
                'https://i.ibb.co/2Y7Tbsvf/Whats-App-Image-2025-06-27-at-1-37-02-AM-1.jpg',
            ],
            4 => [
                'https://i.ibb.co/2YY8rcYg/Whats-App-Image-2025-06-27-at-1-37-01-AM-3.jpg',
                'https://i.ibb.co/21tF9GwD/Whats-App-Image-2025-06-27-at-1-37-00-AM.jpg',
                'https://i.ibb.co/1YTcptHb/Whats-App-Image-2025-06-27-at-1-37-01-AM-5.jpg',
            ],
        ];

        foreach ($images as $cabinId => $urls) {
            foreach ($urls as $url) {
                CabinImage::create([
                    'cabin_id' => $cabinId,
                    'url' => $url,
                    'description' => fake()->sentence(5),
                ]);
            }
        }
    }
}
