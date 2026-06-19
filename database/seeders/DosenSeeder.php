<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Dosen::create(['nidn' => '11223344', 'nama_dosen' => 'Prof.Dr. Ir. Budi Santoso']);
        $Dosen::create(['nidn' => '55667788', 'nama_dosen' => 'Siti Aminah, M.Kom']);
    }
}
