<?php

namespace Database\Seeders;

use App\Models\AuditPlan;
use Illuminate\Database\Seeder;

class AMI extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AuditPlan::create([
            'faculty_id' => 1,
            'study_program_id' => 4,
            'lead_auditor_id' => 17,
            'auditor_1_id' => 18,
            'auditor_2_id' => 18,
            'status' => "proses",
            'tahun' => 2023,
        ]);
    }
}
