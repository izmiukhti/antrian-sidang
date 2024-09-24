<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Membuat 50 data dummy untuk User
        User::factory()->count(10)->create();
    }
}
