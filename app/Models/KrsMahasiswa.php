<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KrsMahasiswa extends Model
{
    use HasFactory;

    protected $table = 'krs_mahasiswa';

    protected $fillable = [
        'mahasiswa_id',
        'jadwal_kelas_id',
    ];

    // Relasi ke User (Mahasiswa)
    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }

    // Relasi ke Jadwal Kelas
    public function jadwalKelas()
    {
        return $this->belongsTo(JadwalKelas::class, 'jadwal_kelas_id');
    }
}
