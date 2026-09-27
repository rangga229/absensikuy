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
    Schema::create('kehadiran', function (Blueprint $table) {
        $table->id();
        $table->foreignId('sesi_absensi_id')->constrained('sesi_absensi')->cascadeOnDelete();
        $table->foreignId('mahasiswa_id')->constrained('users')->cascadeOnDelete();
        $table->dateTime('waktu_scan')->nullable();
        $table->enum('status', ['hadir', 'izin', 'sakit', 'alpa'])->default('alpa');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kehadiran');
    }
};
