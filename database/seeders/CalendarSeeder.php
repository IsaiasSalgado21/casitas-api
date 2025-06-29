<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Calendar;
use App\Models\Cabin;
use Illuminate\Support\Carbon;

class CalendarSeeder extends Seeder
{
    public function run(): void
    {
        $cabinIds = Cabin::pluck('id')->all();

        // Rango de fechas: Hoy + próximos 15 días
        $startDate = Carbon::today();
        $days = 15;

        foreach ($cabinIds as $cabinId) {
            for ($i = 0; $i < $days; $i++) {
                $date = $startDate->copy()->addDays($i);

                // Randomiza el estado
                $status = fake()->randomElement(['available', 'booked', 'maintenance', 'blocked']);

                Calendar::create([
                    'cabin_id' => $cabinId,
                    'date' => $date->format('Y-m-d'),
                    'status' => $status,
                ]);
            }
        }
    }
}
