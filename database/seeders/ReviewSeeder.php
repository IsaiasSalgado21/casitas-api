<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use App\Models\User;
use App\Models\Cabin;
use Illuminate\Support\Carbon;

class ReviewSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('user_id')->all();
        $cabins = Cabin::pluck('id')->all();

        foreach ($cabins as $cabinId) {
            $randKeys = (array) array_rand($users, rand(1, min(3, count($users))));
            foreach ($randKeys as $i) {
                Review::create([
                    'user_id' => $users[$i],
                    'cabin_id' => $cabinId,
                    'rating' => rand(1, 5),
                    'comment' => fake()->sentence(),
                    'review_date' => now(),
                    'status' => 'published',
                ]);
            }
        }
    }
}