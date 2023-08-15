<?php

namespace Database\Seeders;

use App\Models\Standard;
use Illuminate\Database\Seeder;

class Standar extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Standard::create([
            'name' => "Standar Visi Misi",
            'desc' => "Visi dan Misi",
            'value' => "<p>Standar Pembuatan Visi Misi</p>",
        ]);
    }
}
