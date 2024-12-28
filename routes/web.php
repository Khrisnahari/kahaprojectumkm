<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelolaUmkmController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProdukUmkmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmkmController;
use App\Http\Middleware\CheckProductOwnership;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'home'])->name('home');

Route::resource('/products', ProductController::class);

// Autentikasi
Route::get('/login',   [AuthController::class, 'login'])->name('login');
Route::get('/registrasi',   [AuthController::class, 'registrasi'])->name('registrasi');
Route::post('/login',   [AuthController::class, 'prosesLogin'])->name('proses.login');
Route::post('/registrasi',   [AuthController::class, 'prosesRegistrasi'])->name('proses.registrasi');
Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/umkm', UmkmController::class);
});

Route::middleware(['auth:owner'])->group(function () {
    Route::resource('/kelolaumkm', KelolaUmkmController::class);
    Route::resource('/profile', ProfileController::class);
    Route::resource('/produk', ProdukUmkmController::class)->except(['show','edit']);

    // Route untuk show
    Route::get('/produk/{id}', [ProdukUmkmController::class, 'show'])
       ->middleware(CheckProductOwnership::class)
       ->name('produk.show');

   // Route untuk edit
   Route::get('/produk/{id}/edit', [ProdukUmkmController::class, 'edit'])
       ->middleware(CheckProductOwnership::class)
       ->name('produk.edit');
    
});

// UMKM
Route::post('/umkm/{id}/verifikasi', [UmkmController::class, 'verifikasi'])->name('umkm.verifikasi');

// Frontend DAMAR
Route::get('home',   [HomeController::class, 'home'])->name('home');

// Route::middleware(['auth:admin', PreventBackHistory::class])->group(function () {
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
//     Route::resource('/umkm', UmkmController::class);
// });
