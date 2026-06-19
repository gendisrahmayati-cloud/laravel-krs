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

    // AKSES KRS UNTUK MAHASISWA/USER (Melihat daftar dan Mengisi Formulir)
    Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');          
    Route::get('/krs/create', [KrsController::class, 'create'])->name('krs.create');  
    Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');          
    
    // Akses melihat daftar Dosen
    Route::get('/dosen', [DosenController::class, 'index'])->name('dosen.index');

    // --- RUTE MAHASISWA (MODUL 9) ---
    // Halaman daftar mahasiswa
    Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa.index');

    // Halaman form tambah mahasiswa
    Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');

    // Proses simpan data form mahasiswa
    Route::post('/mahasiswa', [MahasiswaController::class, 'store'])->name('mahasiswa.store');


    // ====================================================================
    // GRUP DALAM: HANYA BOLEH DIAKSES OLEH AKUN YANG MEMILIKI ROLE 'ADMIN'
    // ====================================================================
    Route::middleware('admin')->group(function () {
        // Hanya Admin yang boleh mengubah atau menghapus data KRS mahasiswa
        Route::get('/krs/{id}/edit', [KrsController::class, 'edit'])->name('krs.edit');
        Route::put('/krs/{id}', [KrsController::class, 'update'])->name('krs.update');
        Route::delete('/krs/{id}', [KrsController::class, 'destroy'])->name('krs.destroy');

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