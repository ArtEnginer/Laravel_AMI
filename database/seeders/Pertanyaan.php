<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class Pertanyaan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Question::create([
            'standard_id' => 1,
            'questionText' => "<p>Apakah Visi misi Prodi Sudah sesuai dengan kaidah ?</p>",
        ]);
        Question::create([
            'standard_id' => 1,
            'questionText' => "<p>Apakah Visi misi Prodi Sudah Mencerminkan Cita-cita ?</p>",
        ]);
    }
}
