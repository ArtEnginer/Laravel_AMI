<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Sistem Informasi',
            'kaprodi' => 'Kaprodi SI',
            'nidn' => '200000000001',
            'faculty_id' => '1',
            'email' => 'prodi01@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi01',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Informatika',
            'kaprodi' => 'Kaprodi Informatika',
            'nidn' => '200000000002',
            'faculty_id' => '1',
            'email' => 'prodi02@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi02',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Agribisnis',
            'kaprodi' => 'Kaprodi 03',
            'nidn' => '200000000003',
            'faculty_id' => '1',
            'email' => 'prodi03@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi03',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Teknik Elektro',
            'kaprodi' => 'Kaprodi 04',
            'nidn' => '200000000004',
            'faculty_id' => '1',
            'email' => 'prodi04@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi04',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Farmasi',
            'kaprodi' => 'Kaprodi 05',
            'nidn' => '200000000005',
            'faculty_id' => '1',
            'email' => 'prodi05@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi05',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Pendidikan Guru Sekolah Dasar',
            'kaprodi' => 'Kaprodi 06',
            'nidn' => '200000000006',
            'faculty_id' => '2',
            'email' => 'prodi06@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi06',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Pendidikan Matematika',
            'kaprodi' => 'Kaprodi 07',
            'nidn' => '200000000007',
            'faculty_id' => '2',
            'email' => 'prodi07@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi07',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Pendidikan Bahasa Indonesia',
            'kaprodi' => 'Kaprodi 08',
            'nidn' => '200000000008',
            'faculty_id' => '2',
            'email' => 'prodi08@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi08',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Pendidikan Bahasa Inggris',
            'kaprodi' => 'Kaprodi 09',
            'nidn' => '200000000009',
            'faculty_id' => '2',
            'email' => 'prodi09@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi09',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Manajemen',
            'kaprodi' => 'Kaprodi 10',
            'nidn' => '200000000010',
            'faculty_id' => '3',
            'email' => 'prodi10@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi10',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Akuntansi',
            'kaprodi' => 'Kaprodi 11',
            'nidn' => '200000000011',
            'faculty_id' => '3',
            'email' => 'prodi11@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi11',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Hubungan Internasional',
            'kaprodi' => 'Kaprodi 12',
            'nidn' => '200000000012',
            'faculty_id' => '4',
            'email' => 'prodi12@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi12',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Ilmu Komunikasi',
            'kaprodi' => 'Kaprodi 13',
            'nidn' => '200000000013',
            'faculty_id' => '4',
            'email' => 'prodi13@gmail.com',
            'email_verified_at' => now(),
            'role' => 'prodi',
            'username' => 'prodi13',
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
            'study_program_id' => '9',
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
            'study_program_id' => '11',
            'faculty_id' => '3',
            'nidn' => '300000000003',
            'name' => 'Auditor 03',
            'email' => 'auditor03@gmail.com',
            'email_verified_at' => now(),
            'role' => 'auditor',
            'username' => 'auditor03',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'study_program_id' => '13',
            'faculty_id' => '4',
            'nidn' => '300000000003',
            'name' => 'Auditor 04',
            'email' => 'auditor04@gmail.com',
            'email_verified_at' => now(),
            'role' => 'auditor',
            'username' => 'auditor04',
            'password' => Hash::make('password'),
        ]);

        // User::factory(3)->create();
    }
}
