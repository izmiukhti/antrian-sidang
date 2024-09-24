<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\JenisSidang;
use App\Models\Antrian;
use Illuminate\Database\Eloquent\Factories\Factory;

class AntrianFactory extends Factory
{
    protected $model = Antrian::class;

    public function definition()
    {
        return [
            'nomor_antrian' => strtoupper($this->faker->bothify('A###')),
            'status_sidang' => $this->faker->randomElement(['Pending', 'Proses', 'Selesai']),
            'jadwal_sidang' => $this->faker->dateTimeBetween('now', '+1 month'),
            'user_id' => User::factory(), // Membuat user baru untuk setiap antrian
            'jenis_sidang_id' => JenisSidang::factory(), // Membuat jenis sidang baru untuk setiap antrian
        ];
    }
}
