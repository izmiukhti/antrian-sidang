<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Antrian;

class AntrianSeeder extends Seeder
{
    public function run()
    {
        // Membuat 50 data dummy untuk tabel antrians
        Antrian::factory()->count(100)->create();
    }
}
