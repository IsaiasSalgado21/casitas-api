<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'user_id' => Str::uuid(),
            'first_name' => 'Admin',
            'last_name' => 'Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
            'provider' => 'local',
            'phone' => '+521234567890',
            'address' => 'Av. Siempre Viva 123',
            'status' => 'active',
            'verified' => true,
            'recovery_token' => null,
            'recovery_exp' => null,
            'last_login_at' => now(),
        ]);

        User::factory(10)->create();

        $this->call([
            CabinSeeder::class,
            CabinImageSeeder::class,
            AvailabilitySeeder::class,
            CalendarSeeder::class,
            ReservationSeeder::class,
            ReviewAlertSeeder::class,
            PaymentSeeder::class,
            ReservationHistorySeeder::class,
            ReviewSeeder::class,
            UserImageSeeder::class,
            NotificationSeeder::class,
        ]);
    }
}
