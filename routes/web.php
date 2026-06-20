<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Halaman Dasbor Utama (Bawaan Laravel Breeze)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ====================================================================
// GRUP UTAMA: Harus LOGIN dulu (Bisa diakses oleh ADMIN maupun USER)
// ====================================================================
Route::middleware('auth')->group(function () {
    
    // Fitur Manajemen Profil Pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- RUTE KELOLA PENGAJUAN KRS MAHASISWA ---
    // User biasa dan admin bisa melihat, membuka form, dan mengirim data mahasiswa baru
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
    
    // Akses melihat daftar Dosen
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');

    // ====================================================================
    // GRUP DALAM: HANYA BOLEH DIAKSES OLEH AKUN YANG MEMILIKI ROLE 'ADMIN'
    // ====================================================================
    Route::middleware('admin')->group(function () {
        
        // Hanya Admin yang bisa menambah, mengubah, dan menghapus master data dosen
        Route::get('/dosen/create', [DosenController::class, 'create'])->name('dosen.create');
        Route::post('/dosen', [DosenController::class, 'store'])->name('dosen.store');
        Route::get('/dosen/{id}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
        Route::put('/dosen/{id}', [DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/dosen/{id}', [DosenController::class, 'destroy'])->name('dosen.destroy');
    });
});

// Memuat rute bawaan Laravel Breeze (Login, Register, Logout)
require __DIR__ . '/auth.php';