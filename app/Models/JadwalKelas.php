<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalKelas extends Model
{
    protected $table = 'jadwal_kelas';
    protected $fillable = ['mata_kuliah_id', 'dosen_id', 'nama_kelas', 'lokasi', 'hari', 'jam_mulai', 'jam_selesai'];

    // Relasi ke Mata Kuliah
    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_id');
    }

    // Relasi ke Dosen (Tabel Users)
    public function dosen()
    {
        return $this->belongsTo(User::class, 'dosen_id');
    }
}
