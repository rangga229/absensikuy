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
    Schema::create('jadwal_kelas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('mata_kuliah_id')->constrained('mata_kuliah')->cascadeOnDelete();
        $table->foreignId('dosen_id')->constrained('users')->cascadeOnDelete();
        $table->string('nama_kelas');
        $table->string('hari');
        $table->time('jam_mulai');
        $table->time('jam_selesai');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_kelas');
    }
};
