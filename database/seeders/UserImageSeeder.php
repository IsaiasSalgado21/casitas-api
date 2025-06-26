<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserImage;

class UserImageSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            UserImage::create([
                'user_id' => $user->user_id,
                'url' => 'https://i.pravatar.cc/150?u=' . $user->user_id,
                'type' => 'avatar',
            ]);
        }
    }
}
    