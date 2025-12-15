<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;


Route::get('/', function () {
    return "Sistem Pelaporan Masalah - Teknik Informatika";
});

Route::get('/laporan',
    [LaporanController::class, 'index']
)->name('laporan.index');


Route::resource('mahasiswa', MahasiswaController::class);
Route::resource('dosen', DosenController::class);