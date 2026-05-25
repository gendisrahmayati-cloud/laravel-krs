<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Krs;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Krs::factory(15)->create();
    }
}
