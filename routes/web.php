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
});

// 4. Ruangan Khusus Dosen (Dijaga middleware role:dosen)
Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('/dosen/dashboard', function () {
        return view('dosen.dashboard');
    })->name('dosen.dashboard');
});

// 5. Ruangan Khusus Mahasiswa (Dijaga middleware role:mahasiswa)
Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');
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
