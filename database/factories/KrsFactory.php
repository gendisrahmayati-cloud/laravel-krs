<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KrsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama_mahasiswa' => fake()->name(),

            'nim' => fake()->unique()
                ->numerify('2301###'),

            'semester' => fake()
                ->numberBetween(1, 8),

            'daftar_mata_kuliah' => implode(', ', [
                'Pemrograman Web',
                'Basis Data',
                'Matematika Diskrit',
                'Jaringan Komputer'
            ]),

            'total_sks' => fake()
                ->numberBetween(18, 24),

            'status_persetujuan' => 'Pending'
        ];
    }
}
