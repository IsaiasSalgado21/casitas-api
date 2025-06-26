<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Availability;
use App\Models\Cabin;
use Illuminate\Support\Carbon;

class AvailabilitySeeder extends Seeder
{
    public function run(): void
    {
        $cabins = Cabin::pluck('id')->all();

        foreach ($cabins as $cabinId) {
            for ($i = 0; $i < 5; $i++) {
                Availability::create([
                    'cabin_id' => $cabinId,
                    'available_from' => Carbon::now()->addDays($i * 10)->toDateString(),
                    'available_to' => Carbon::now()->addDays(($i * 10) + 5)->toDateString(),
                ]);
            }
        }
    }
}
