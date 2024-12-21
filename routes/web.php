<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

Route::resource('/products', \App\Http\Controllers\ProductController::class);


Route::get('/login',   [AuthController::class, 'login'])->name('login');
Route::post('/login',   [AuthController::class, 'prosesLogin'])->name('proses.login');
Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/umkm', UmkmController::class);
});

// UMKM
Route::post('/umkm/{id}/verifikasi', [UmkmController::class, 'verifikasi'])->name('umkm.verifikasi');

// Route::middleware(['auth:admin', PreventBackHistory::class])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::resource('/umkm', UmkmController::class);
// });
