<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\JadwalKelas;
use App\Models\KrsMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KrsController extends Controller
{
    public function index()
    {
        $mahasiswa_id = Auth::id();

        // 1. Tarik data jadwal yang SUDAH diambil oleh mahasiswa ini
        $krs_saya = KrsMahasiswa::with(['jadwalKelas.mataKuliah', 'jadwalKelas.dosen'])
            ->where('mahasiswa_id', $mahasiswa_id)
            ->get();

        // Ambil array ID jadwal yang sudah diambil untuk proses filter
        $jadwal_diambil_ids = $krs_saya->pluck('jadwal_kelas_id')->toArray();

        // 2. Tarik data jadwal yang TERSEDIA (belum diambil)
        $jadwal_tersedia = JadwalKelas::with(['mataKuliah', 'dosen'])
            ->whereNotIn('id', $jadwal_diambil_ids)
            ->get();

        return view('mahasiswa.krs.index', compact('krs_saya', 'jadwal_tersedia'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_kelas_id' => 'required|exists:jadwal_kelas,id',
        ]);

        $mahasiswa_id = Auth::id();

        // Validasi Ekstra: Pastikan belum pernah diambil (Mencegah duplikat)
        $sudahAda = KrsMahasiswa::where('mahasiswa_id', $mahasiswa_id)
            ->where('jadwal_kelas_id', $request->jadwal_kelas_id)
            ->first();

        if ($sudahAda) {
            return back()->with('error', 'Kelas ini sudah ada di KRS Anda.');
        }

        // Simpan ke database
        KrsMahasiswa::create([
            'mahasiswa_id' => $mahasiswa_id,
            'jadwal_kelas_id' => $request->jadwal_kelas_id,
        ]);

        return back()->with('success', 'Berhasil mengambil kelas!');
    }

    public function destroy(string $id)
    {
        $krs = KrsMahasiswa::findOrFail($id);

        // Keamanan tambahan: Pastikan mahasiswa hanya bisa menghapus KRS miliknya sendiri
        if ($krs->mahasiswa_id == Auth::id()) {
            $krs->delete();
            return back()->with('success', 'Kelas berhasil dibatalkan dari KRS.');
        }

        return back()->with('error', 'Akses ditolak!');
    }
}
