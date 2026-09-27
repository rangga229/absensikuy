<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KrsMahasiswa extends Model
{
    protected $table = 'krs_mahasiswa';
    protected $fillable = ['mahasiswa_id', 'jadwal_kelas_id'];
}
