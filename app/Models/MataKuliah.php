<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    protected $table = 'mata_kuliah';
    protected $fillable = ['kode_mk', 'nama_mk', 'sks'];

    // Relasi ke Jadwal Kelas
    public function jadwalKelas()
    {
        return $this->hasMany(JadwalKelas::class, 'mata_kuliah_id');
    }
}
