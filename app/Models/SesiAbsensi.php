<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SesiAbsensi extends Model
{
    protected $table = 'sesi_absensi';
    protected $fillable = ['jadwal_kelas_id', 'tanggal', 'qr_token', 'status'];
}
