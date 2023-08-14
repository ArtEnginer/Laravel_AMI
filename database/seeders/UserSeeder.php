<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'username' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // Admin
        User::factory()->create([
            'nidn' => '000000000001',
            'name' => 'Admin 01',
            'email' => 'admin01@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'username' => 'admin01',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'nidn' => '000000000002',
            'name' => 'Admin 02',
            'email' => 'admin02@gmail.com',
            'email_verified_at' => now(),
            'role' => 'admin',
            'username' => 'admin02',
            'password' => Hash::make('password'),
        ]);

        // Prodi
        User::factory()->create([
            'name' => 'Prodi 01',
            'kaprodi' => 'Kaprodi 01',
            'nidn' => '200000000001',
            'email' => 'prodi01@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi01',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Prodi 02',
            'kaprodi' => 'Kaprodi 02',
            'nidn' => '200000000002',
            'email' => 'prodi02@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi02',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Prodi 03',
            'kaprodi' => 'Kaprodi 03',
            'nidn' => '200000000003',
            'email' => 'prodi03@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi03',
            'password' => Hash::make('password'),
        ]);

        // Auditor
        User::factory()->create([
            'study_program_id' => '4',
            'faculty_id' => '1',
            'nidn' => '300000000001',
            'name' => 'Auditor 01',
            'email' => 'auditor01@gmail.com',
            'email_verified_at' => now(),
            'role' => 'auditor',
            'username' => 'auditor01',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'study_program_id' => '5',
            'faculty_id' => '2',
            'nidn' => '300000000002',
            'name' => 'Auditor 02',
            'email' => 'auditor02@gmail.com',
            'email_verified_at' => now(),
            'role' => 'auditor',
            'username' => 'auditor02',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'study_program_id' => '6',
            'faculty_id' => '3',
            'nidn' => '300000000003',
            'name' => 'Auditor 03',
            'email' => 'auditor03@gmail.com',
            'email_verified_at' => now(),
            'role' => 'auditor',
            'username' => 'auditor03',
            'password' => Hash::make('password'),
        ]);

        // User::factory(3)->create();
    }
}
