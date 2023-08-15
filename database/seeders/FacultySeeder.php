<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faculty::create([
            'name' => 'Sains dan Teknologi',
            'dekan' => 'Dekan FST',
            'nidn' => '010000000001',
            'telp' => '082028192301',
        ]);
        Faculty::create([
            'name' => 'Ekonomi dan Bisnis',
            'dekan' => 'Dekan FEB',
            'nidn' => '010000000002',
            'telp' => '082028192302',
        ]);
        Faculty::create([
            'name' => 'Keguruan dan Ilmu Pendidikan',
            'dekan' => 'Dekan FKIP',
            'nidn' => '010000000003',
            'telp' => '082028192303',
        ]);
        Faculty::create([
            'name' => 'Ilmu Sosial dan Ilmu Politik',
            'dekan' => 'Dekan FISIP',
            'nidn' => '010000000003',
            'telp' => '082028192303',
        ]);
    }
}
