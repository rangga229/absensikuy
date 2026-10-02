<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    use HasFactory;

    protected $table = 'kehadiran'; // Nama tabel anti-plural

    protected $fillable = [
        'sesi_absensi_id',
        'mahasiswa_id',
        'waktu_hadir',
        'status', // misalnya: 'hadir', 'sakit', 'izin'
    ];

    public function sesiAbsensi()
    {
        return $this->belongsTo(SesiAbsensi::class, 'sesi_absensi_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'mahasiswa_id');
    }
}
