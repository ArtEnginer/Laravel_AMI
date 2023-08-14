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
            'name' => 'Fakultas 01',
            'dekan' => 'Dekan 01',
            'nidn'  => '010000000001',
            'telp' => '082028192301',
        ]);
        Faculty::create([
            'name' => 'Fakultas 02',
            'dekan' => 'Dekan 02',
            'nidn' => '010000000002',
            'telp' => '082028192302',
        ]);
        Faculty::create([
            'name' => 'Fakultas 03',
            'dekan' => 'Dekan 03',
            'nidn' => '010000000003',
            'telp' => '082028192303',
        ]);
    }
}
