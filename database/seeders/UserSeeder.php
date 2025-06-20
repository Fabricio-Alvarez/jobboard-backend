<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {

        User::factory()->count(10)->create(['role' => User::ROLE_CANDIDATE]);
        User::factory()->count(10)->create(['role' => User::ROLE_RECRUITER]);
    }
}
