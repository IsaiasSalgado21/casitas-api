<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\Reservation;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $reservations = Reservation::pluck('id')->all();

        foreach ($reservations as $resId) {
            Payment::create([
                'reservation_id' => $resId,
                'payment_method' => fake()->randomElement(['card', 'transfer', 'cash']),
                'amount' => rand(1000, 5000),
                'currency' => 'MXN',
                'payment_type' => fake()->randomElement(['initial', 'full']),
                'payment_status' => fake()->randomElement(['completed', 'pending']),
                'transaction_details' => 'TX-' . strtoupper(Str::random(10)),
                'payment_date' => Carbon::now()->subDays(rand(1, 30))->format('Y-m-d'),
            ]);
        }
    }
}
