<?php

namespace Database\Factories;

use App\Models\JenisSidang;
use Illuminate\Database\Eloquent\Factories\Factory;

class JenisSidangFactory extends Factory
{
    protected $model = JenisSidang::class;

    public function definition()
    {
        return [
            'nama_jenis_sidang' => $this->faker->word, // Misalnya 'Perceraian', 'Pernikahan', dll.
        ];
    }
}

