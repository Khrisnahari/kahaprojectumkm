<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

Route::resource('/products', \App\Http\Controllers\ProductController::class);
Route::resource('/dashboard', DashboardController::class);
Route::resource('/umkm', UmkmController::class);

Route::get('/login',   [AuthController::class, 'login'])->name('login');
Route::post('/login',   [AuthController::class, 'prosesLogin'])->name('proses.login');
Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('/products', ProductController::class);
    // Route::get('/riwayat-pesanan', PesananController::class)->name('pesanan.riwayat');
});
