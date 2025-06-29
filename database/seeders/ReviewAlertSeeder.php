<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReviewAlert;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Carbon;

class ReviewAlertSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('user_id')->all(); // UUID
        $reservations = Reservation::pluck('id')->all();

        if (empty($users) || empty($reservations)) {
            $this->command->warn("No hay usuarios o reservaciones para generar alertas.");
            return;
        }

        foreach (range(1, 20) as $i) {
            ReviewAlert::create([
                'user_id' => fake()->randomElement($users),
                'reservation_id' => fake()->randomElement($reservations),
                'event_type' => fake()->randomElement(['on_completion', 'post_use']),
                'alert_date' => Carbon::now()->addDays(rand(-5, 10)),
                'sent' => fake()->boolean(30), // 30% de probabilidad de estar enviado
            ]);
        }
    }
}
