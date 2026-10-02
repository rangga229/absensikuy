<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalMengajarController extends Controller
{
    public function index()
    {
        // Ambil ID dosen yang sedang login
        $dosen_id = Auth::id();

        // Tarik jadwal yang HANYA diajar oleh dosen ini
        $jadwal_mengajar = JadwalKelas::with(['mataKuliah'])
            ->where('dosen_id', $dosen_id)
            ->get();

        // Ambil array ID jadwal kelas milik dosen ini
        $jadwal_ids = $jadwal_mengajar->pluck('id')->toArray();

        // 2. Tarik riwayat sesi absensi berdasarkan jadwal tersebut (Tabel Bawah)
        $riwayat_sesi = \App\Models\SesiAbsensi::with(['jadwalKelas.mataKuliah'])
            ->whereIn('jadwal_kelas_id', $jadwal_ids)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dosen.jadwal.index', compact('jadwal_mengajar', 'riwayat_sesi'));
    }
}
