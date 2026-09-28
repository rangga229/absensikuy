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
        Schema::table('jadwal_kelas', function (Blueprint $table) {
            // Menambahkan kolom lokasi setelah kolom nama_kelas
            $table->string('lokasi', 100)->after('nama_kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_kelas', function (Blueprint $table) {
            $table->dropColumn('lokasi');
        });
    }
};
