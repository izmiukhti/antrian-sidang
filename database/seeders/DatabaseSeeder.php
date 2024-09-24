<?php

namespace Database\Seeders;

use App\Models\Antrian;
use App\Models\JenisSidang;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        // JenisSidang::factory(10)->create();
        // Antrian::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        User::factory()->create([
            'name' => 'izmi',
            'email' => 'izmi@gmail.com',
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        // $this->call([
        //     UserSeeder::class,
        //     JenisSidangSeeder::class,
        //     AntrianSeeder::class,
            
        // ]);
    }
}
