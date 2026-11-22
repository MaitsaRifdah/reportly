<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\InteraksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\PenangananController;
use App\Http\Controllers\VerifikasiController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('login'));

// Auth
Route::get('/register', [AuthController::class,'showRegister'])->name('register');
Route::post('/register', [AuthController::class,'register']);
Route::get('/login',    [AuthController::class,'showLogin'])->name('login');
Route::post('/login',   [AuthController::class,'login']);
Route::post('/logout',  [AuthController::class,'logout'])->name('logout');

// ===== WARGA =====
Route::middleware(['auth','role:warga'])->prefix('warga')->name('warga.')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'warga'])->name('dashboard');
    Route::get('/laporan/create', [LaporanController::class,'create'])->name('laporan.create');
    Route::post('/laporan',       [LaporanController::class,'store'])->name('laporan.store');
    Route::get('/laporan-saya',   [LaporanController::class,'saya'])->name('laporan.saya');
});

// ===== LAPORAN PUBLIK & DETAIL (login semua role) =====
Route::middleware('auth')->group(function () {
    Route::get('/laporan',          [LaporanController::class,'index'])->name('laporan.public');
    Route::get('/laporan/{laporan}',[LaporanController::class,'show'])->name('laporan.show');
    Route::post('/laporan/{laporan}/upvote',   [InteraksiController::class,'upvote'])->name('laporan.upvote');
    Route::post('/laporan/{laporan}/komentar', [InteraksiController::class,'komentar'])->name('laporan.komentar');
});

// ===== ADMIN =====
Route::middleware(['auth','role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class,'admin'])->name('dashboard');

    Route::get('/verifikasi',              [VerifikasiController::class,'index'])->name('verifikasi.index');
    Route::post('/verifikasi/{laporan}',   [VerifikasiController::class,'verifikasi'])->name('verifikasi.aksi');
    Route::post('/tolak/{laporan}',        [VerifikasiController::class,'tolak'])->name('verifikasi.tolak');

    Route::get('/kategori',                [MasterDataController::class,'kategoriIndex'])->name('kategori.index');
    Route::post('/kategori',               [MasterDataController::class,'kategoriStore'])->name('kategori.store');
    Route::put('/kategori/{kategori}',     [MasterDataController::class,'kategoriUpdate'])->name('kategori.update');
    Route::delete('/kategori/{kategori}',  [MasterDataController::class,'kategoriDestroy'])->name('kategori.destroy');

    Route::get('/dinas',                   [MasterDataController::class,'dinasIndex'])->name('dinas.index');
    Route::post('/dinas',                  [MasterDataController::class,'dinasStore'])->name('dinas.store');
    Route::put('/dinas/{dinas}',           [MasterDataController::class,'dinasUpdate'])->name('dinas.update');
    Route::delete('/dinas/{dinas}',        [MasterDataController::class,'dinasDestroy'])->name('dinas.destroy');

    Route::get('/users',                   [MasterDataController::class,'userIndex'])->name('user.index');
    Route::post('/users',                  [MasterDataController::class,'userStore'])->name('user.store');
    Route::delete('/users/{user}',         [MasterDataController::class,'userDestroy'])->name('user.destroy');

    Route::get('/export/pdf',   [ExportController::class,'pdf'])->name('export.pdf');
    Route::get('/export/excel', [ExportController::class,'excel'])->name('export.excel');
});

// ===== PETUGAS =====
Route::middleware(['auth','role:petugas'])->prefix('petugas')->name('petugas.')->group(function () {
    Route::get('/dashboard',          [DashboardController::class,'petugas'])->name('dashboard');
    Route::get('/daftar-tugas',       [PenangananController::class,'index'])->name('daftar_tugas');
    Route::get('/tugas/{laporan}/form', [PenangananController::class,'formProgres'])->name('form_progres');
    Route::post('/tugas/{laporan}',   [PenangananController::class,'simpanProgres'])->name('simpan_progres');
});