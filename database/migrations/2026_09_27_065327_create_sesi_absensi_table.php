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
    Schema::create('sesi_absensi', function (Blueprint $table) {
        $table->id();
        $table->foreignId('jadwal_kelas_id')->constrained('jadwal_kelas')->cascadeOnDelete();
        $table->date('tanggal');
        $table->string('qr_token')->unique();
        $table->enum('status', ['open', 'closed'])->default('open');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesi_absensi');
    }
};
