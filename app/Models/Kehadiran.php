<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $table = 'kehadiran';
    protected $fillable = ['sesi_absensi_id', 'mahasiswa_id', 'waktu_scan', 'status'];
}
