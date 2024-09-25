<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\JenisSidang;

class JenisSidangSeeder extends Seeder
{
    public function run()
    {
        //Membuat 5 data dummy untuk tabel jenis_sidang
        JenisSidang::factory()->count(5)->create([
            'nama_jenis_sidang' => 'nikah',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        JenisSidang::factory()->count(5)->create([
            'nama_jenis_sidang' => 'cerai',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        JenisSidang::factory()->count(5)->create([
            'nama_jenis_sidang' => 'warisan',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
    }
}
