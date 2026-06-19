<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(DosenSeeder::class);
    }
}
