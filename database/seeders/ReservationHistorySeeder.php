<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReservationHistory;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservationHistorySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $reservations = Reservation::all();

        if ($users->isEmpty() || $reservations->isEmpty()) {
            $this->command->warn('No hay usuarios o reservaciones en la base de datos. Ejecuta otros seeders primero.');
            return;
        }

        foreach ($reservations as $reservation) {
            ReservationHistory::create([
                'user_id' => $users->random()->user_id,
                'reservation_id' => $reservation->id,
                'previous_status' => 'pending',
                'new_status' => 'confirmed',
                'event_date' => now()->subDays(rand(1, 30)),
                'details' => 'Actualización automática de estado por el sistema.',
            ]);
        }
    }
}
