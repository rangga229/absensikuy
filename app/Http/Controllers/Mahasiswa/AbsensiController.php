<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kehadiran;
use App\Models\KrsMahasiswa;
use App\Models\SesiAbsensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    // Menampilkan halaman kamera scanner
    public function scan()
    {
        return view('mahasiswa.absensi.scan');
    }

    // Memproses hasil scan (Token)
    public function store(Request $request)
    {
        $request->validate([
            'qr_token' => 'required|string'
        ]);

        $mahasiswa_id = Auth::id();
        $token = $request->qr_token;

        // 1. Cek apakah QR Token valid dan sesi masih 'open'
        $sesi = SesiAbsensi::where('qr_token', $token)->where('status', 'open')->first();
        if (!$sesi) {
            return back()->with('error', 'QR Code tidak valid atau sesi absensi sudah ditutup oleh dosen.');
        }

        // 2. Cek apakah mahasiswa mengambil kelas ini di KRS
        $cekKrs = KrsMahasiswa::where('mahasiswa_id', $mahasiswa_id)
            ->where('jadwal_kelas_id', $sesi->jadwal_kelas_id)
            ->first();
        if (!$cekKrs) {
            return back()->with('error', 'Akses ditolak! Anda tidak terdaftar di kelas ini.');
        }

        // 3. Cek apakah mahasiswa sudah absen hari ini di sesi ini (mencegah absen dobel)
        $sudahAbsen = Kehadiran::where('sesi_absensi_id', $sesi->id)
            ->where('mahasiswa_id', $mahasiswa_id)
            ->first();
        if ($sudahAbsen) {
            return back()->with('error', 'Anda sudah melakukan absensi untuk sesi ini.');
        }

        // 4. Jika lolos semua keamanan, simpan sebagai Hadir
        Kehadiran::create([
            'sesi_absensi_id' => $sesi->id,
            'mahasiswa_id' => $mahasiswa_id,
            'waktu_hadir' => now(),
            'status' => 'hadir',
        ]);

        return redirect()->route('mahasiswa.dashboard')->with('success', 'Berhasil! Absensi kehadiran Anda telah tercatat.');
    }
}
