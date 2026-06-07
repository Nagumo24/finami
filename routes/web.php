<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\TabunganController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {

    // 1. Dashboard Utama
    Route::get('/', [KeuanganController::class, 'index'])->name('keuangan.index');

    // 2. CRUD Tabungan & Pengeluaran (Menyediakan tabungan.store, pengeluaran.store, dll)
    Route::resource('tabungan', TabunganController::class);
    Route::resource('pengeluaran', PengeluaranController::class);

    // 3. Menu Goals (Menu Ke-2)


    // Pastikan rute url '/goals' atau '/target' kamu mengarah ke sini
    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::post('/goals', [GoalController::class, 'store'])->name('goals.store');
    Route::delete('/goals/{id}', [GoalController::class, 'destroy'])->name('goals.destroy');

    // 4. Menu Profil (Menu Ke-5)
    Route::get('/profil', [KeuanganController::class, 'profil'])->name('keuangan.profil');
    // Rute untuk membersihkan data tabungan dan pengeluaran secara total
    Route::delete('/profil/reset-data', [App\Http\Controllers\ProfilController::class, 'resetData'])->name('profil.resetData');


    // Route Menu Ke-4 (Arus Kas / Riwayat Transaksi)
    Route::get('/arus-kas', [KeuanganController::class, 'arusKas'])->name('keuangan.arus-kas');

    // Route Sub-Menu Pengaturan & Keamanan (Menu Ke-5)
    Route::get('/pengaturan', [KeuanganController::class, 'pengaturan'])->name('keuangan.pengaturan');

    // Route Menu Notifikasi (Akses dari ikon lonceng di Header)
    Route::get('/notifikasi', [KeuanganController::class, 'notifikasi'])->name('keuangan.notifikasi');

    // Rute untuk menambah tabungan ke dalam goal tertentu
    Route::patch('/goals/{id}/tambah-tabungan', [App\Http\Controllers\GoalController::class, 'tambahTabungan'])->name('goals.tambahTabungan');

    // Rute untuk logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

});

Route::middleware('auth')->group(function () {

    Route::get('/profil/log-sistem', [ProfilController::class, 'logSistem'])->name('keuangan.log');
    Route::get('/profil/keamanan', [ProfilController::class, 'keamanan'])->name('keuangan.keamanan');
    Route::put('/profil/keamanan/password', [ProfilController::class, 'updatePassword'])->name('keuangan.keamanan.update');
    Route::patch('/profil/keamanan/identitas', [ProfilController::class, 'updateProfil'])->name('keuangan.profil.update');
});


