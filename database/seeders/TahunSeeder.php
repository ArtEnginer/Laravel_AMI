<?php

namespace Database\Seeders;

use App\Models\Tahun;
use Illuminate\Database\Seeder;

class TahunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tahun::create([
            'value' => 2023,
        ]);
        Tahun::create([
            'value' => 2024,
        ]);
    }
}
