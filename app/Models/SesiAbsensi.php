<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SesiAbsensi extends Model
{
    use HasFactory;

    protected $table = 'sesi_absensi';

    // Sesuaikan dengan nama kolom di migration lamamu
    protected $fillable = [
        'jadwal_kelas_id',
        'tanggal',
        'qr_token',
        'status',
    ];

    public function jadwalKelas()
    {
        return $this->belongsTo(JadwalKelas::class, 'jadwal_kelas_id');
    }
}
