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

        return view('dosen.jadwal.index', compact('jadwal_mengajar'));
    }
}
