<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Carbon;

class NotificationSeeder extends Seeder
{
    public function run(): void
    {
        
        $users = User::pluck('user_id')->all();

        foreach ($users as $userId) {
            foreach (range(1, rand(2, 5)) as $i) {
                Notification::create([
                    'user_id' => $userId,
                    'type' => fake()->randomElement(['reservation_confirmation', 'session_error', 'reminder', 'other']),
                    'message' => fake()->sentence(),
                    'read' => fake()->boolean(50),
                    'sent_at' => Carbon::now()->subDays(rand(0, 10))->format('Y-m-d H:i:s'),
                ]);
            }
        }
    }
}
