<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 1. Rute Halaman Awal (Landing Page)
Route::get('/', function () {
    return view('welcome');
});

// 2. Pengatur Lalu Lintas Utama setelah Login (Role Checker)
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'staf') return redirect()->route('staf.dashboard');
    if ($role === 'dosen') return redirect()->route('dosen.dashboard');

    // Default lempar ke mahasiswa
    return redirect()->route('mahasiswa.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ==========================================
// RUTE KHUSUS BERDASARKAN ROLE
// ==========================================

// 3. Ruangan Khusus Staf (Dijaga middleware role:staf)
Route::middleware(['auth', 'role:staf'])->group(function () {
    Route::get('/staf/dashboard', function () {
        return view('staf.dashboard');
    })->name('staf.dashboard');
    Route::resource('staf/mata-kuliah', \App\Http\Controllers\Staf\MataKuliahController::class)->names('staf.mata-kuliah');
    Route::resource('staf/jadwal-kelas', \App\Http\Controllers\Staf\JadwalKelasController::class)->names('staf.jadwal-kelas');
});

// 4. Ruangan Khusus Dosen (Dijaga middleware role:dosen)
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('dosen.dashboard');
    })->name('dosen.dashboard');

    Route::get('/dosen/jadwal-mengajar', [\App\Http\Controllers\Dosen\JadwalMengajarController::class, 'index'])->name('dosen.jadwal.index');

    // Rute Sesi Absensi 
    Route::post('/dosen/sesi-absensi', [\App\Http\Controllers\Dosen\SesiAbsensiController::class, 'store'])->name('dosen.sesi.store');
    Route::get('/dosen/sesi-absensi/{id}', [\App\Http\Controllers\Dosen\SesiAbsensiController::class, 'show'])->name('dosen.sesi.show');
    Route::put('/dosen/sesi-absensi/{id}', [\App\Http\Controllers\Dosen\SesiAbsensiController::class, 'update'])->name('dosen.sesi.update');

    // Tambahkan Rute Rekap di sini:
    Route::get('/dosen/sesi-absensi/{id}/rekap', [\App\Http\Controllers\Dosen\SesiAbsensiController::class, 'rekap'])->name('dosen.sesi.rekap');
});

// 5. Ruangan Khusus Mahasiswa (Dijaga middleware role:mahasiswa)
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    // Rute KRS Mahasiswa
    Route::get('/mahasiswa/krs', [\App\Http\Controllers\Mahasiswa\KrsController::class, 'index'])->name('mahasiswa.krs.index');
    Route::post('/mahasiswa/krs', [\App\Http\Controllers\Mahasiswa\KrsController::class, 'store'])->name('mahasiswa.krs.store');
    Route::delete('/mahasiswa/krs/{id}', [\App\Http\Controllers\Mahasiswa\KrsController::class, 'destroy'])->name('mahasiswa.krs.destroy');

    // Rute Absensi / Scanner Mahasiswa
    Route::get('/mahasiswa/scan', [\App\Http\Controllers\Mahasiswa\AbsensiController::class, 'scan'])->name('mahasiswa.scan');
    Route::post('/mahasiswa/scan', [\App\Http\Controllers\Mahasiswa\AbsensiController::class, 'store'])->name('mahasiswa.scan.store');
});

// ==========================================
// RUTE BAWAAN BREEZE (JANGAN DIHAPUS)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
