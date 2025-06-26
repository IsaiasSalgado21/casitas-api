<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Cabin;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('user_id')->all();
        $cabins = Cabin::pluck('id')->all();

        foreach (range(1, 10) as $i) {
            $start = Carbon::now()->addDays(rand(1, 30));
            $end = (clone $start)->addDays(rand(2, 7));

            Reservation::create([
                'verification_code' => 'RES-' . strtoupper(Str::random(8)),
                'user_id' => $users[array_rand($users)],
                'cabin_id' => $cabins[array_rand($cabins)],
                'start_date' => $start->format('Y-m-d'),
                'end_date' => $end->format('Y-m-d'),
                'status' => 'pending',
                'total' => rand(2000, 8000),
                'notes' => fake()->sentence(),
                'reminder_sent' => fake()->boolean(30)
            ]);
        }
    }
}
