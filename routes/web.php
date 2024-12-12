<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('login');
});

Route::resource('/products', \App\Http\Controllers\ProductController::class);

Route::get('/login',   [AuthController::class, 'login'])->name('login');
