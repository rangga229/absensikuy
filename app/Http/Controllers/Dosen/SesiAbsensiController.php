<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\SesiAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SesiAbsensiController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'jadwal_kelas_id' => 'required|exists:jadwal_kelas,id'
        ]);

        // Cek status 'open' sesuai migration lamamu
        $sesiAktif = SesiAbsensi::where('jadwal_kelas_id', $request->jadwal_kelas_id)
            ->where('status', 'open')
            ->first();

        if ($sesiAktif) {
            return redirect()->route('dosen.sesi.show', $sesiAktif->id);
        }

        // Sesuaikan dengan kolom tanggal dan qr_token
        $sesiBaru = SesiAbsensi::create([
            'jadwal_kelas_id' => $request->jadwal_kelas_id,
            'qr_token' => Str::random(20), // Bikin token 20 karakter
            'tanggal' => Carbon::now()->toDateString(), // Simpan tanggal hari ini
            'status' => 'open',
        ]);

        return redirect()->route('dosen.sesi.show', $sesiBaru->id);
    }

    public function show($id)
    {
        $sesi = SesiAbsensi::with('jadwalKelas.mataKuliah')->findOrFail($id);
        return view('dosen.sesi.show', compact('sesi'));
    }

    public function update($id)
    {
        $sesi = SesiAbsensi::findOrFail($id);

        // Ubah status jadi 'closed' sesuai enum di database
        $sesi->update([
            'status' => 'closed',
        ]);

        return redirect()->route('dosen.jadwal.index')->with('success', 'Sesi absensi berhasil ditutup. Mahasiswa tidak bisa absen lagi.');
    }

    // Fungsi melihat daftar hadir mahasiswa
    public function rekap($id)
    {
        $sesi = SesiAbsensi::with(['jadwalKelas.mataKuliah'])->findOrFail($id);

        // Tarik data kehadiran beserta relasi mahasiswanya
        $daftar_hadir = \App\Models\Kehadiran::with('mahasiswa')
            ->where('sesi_absensi_id', $id)
            ->orderBy('waktu_hadir', 'asc')
            ->get();

        return view('dosen.sesi.rekap', compact('sesi', 'daftar_hadir'));
    }
}
