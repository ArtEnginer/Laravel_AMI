<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('audit_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('faculty_id');
            $table->foreignId('study_program_id');
            $table->foreignId('lead_auditor_id');
            $table->foreignId('auditor_1_id')->nullable();
            $table->foreignId('auditor_2_id')->nulabble();
            $table->enum('status', ['proses', 'selesai'])->default('proses');
            $table->date('tanggal_rtm')->nullable();
            $table->string('kesimpulan')->nullable();
            $table->string('foto_kegiatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_plans');
    }
};
