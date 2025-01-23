<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KelolaUmkmController;
use App\Http\Controllers\MidtransNotificationController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PesananController;
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
Route::get('/registrasipembeli',   [AuthController::class, 'registrasipembeli'])->name('registrasipembeli');
Route::post('/login',   [AuthController::class, 'prosesLogin'])->name('proses.login');
Route::post('/registrasi',   [AuthController::class, 'prosesRegistrasiPembeli'])->name('proses.registrasipembeli');
Route::get('/logout',   [AuthController::class, 'logout'])->name('logout');

Route::prefix('user')->group(function () {
    Route::post('/registrasi', [AuthController::class, 'prosesRegistrasi'])->name('proses.registrasi');
});

Route::middleware(['auth:admin'])->group(function () {
    Route::resource('/dashboard', DashboardController::class);
    Route::resource('/umkm', UmkmController::class);
    Route::resource('/pembeli', PembeliController::class);
});

Route::middleware(['auth:owner'])->group(function () {
    Route::resource('/kelolaumkm', KelolaUmkmController::class);
    Route::resource('/profile', ProfileController::class);
    Route::get('/detail-umkm/{id}',   [ProfileController::class, 'detailUmkm'])->name('detailumkm');
    Route::put('/update-umkm/{id}',   [ProfileController::class, 'updateUmkm'])->name('updateumkm');

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

Route::middleware(['auth:pembeli'])->group(function () {
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::patch('/cart/{id}/increase', [CartController::class, 'increaseQuantity'])->name('cart.increase');
    Route::patch('/cart/{id}/decrease', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
    // Route::post('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
    Route::post('/midtrans/notification', [MidtransNotificationController::class, 'handleNotification']);
    Route::post('/checkout', [CheckoutController::class, 'proses'])->name('checkout.proses');
    Route::get('/checkout/{id}', [CheckoutController::class, 'checkout'])->name('checkout.index');
    Route::get('/checkout', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/pesanan', [PesananController::class, 'tampilPesanan'])->name('pesanansaya');


});

// UMKM
Route::post('/umkm/{id}/verifikasi', [UmkmController::class, 'verifikasi'])->name('umkm.verifikasi');

// Frontend DAMAR
Route::get('home',   [HomeController::class, 'home'])->name('home');
Route::get('/menu/{owner_id}', [HomeController::class, 'menu'])->name('menu');

// Berita
use App\Http\Controllers\BeritaController;

Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/create', [BeritaController::class, 'create'])->name('berita.create');
Route::post('/berita', [BeritaController::class, 'store'])->name('berita.store');
Route::delete('/berita/{id}', [BeritaController::class, 'destroy'])->name('berita.destroy');
Route::get('/berita/{id}/edit', [BeritaController::class, 'edit'])->name('berita.edit');
Route::put('/berita/{id}', [BeritaController::class, 'update'])->name('berita.update');
Route::get('/berita/{id}', [BeritaController::class, 'show'])->name('berita.show');