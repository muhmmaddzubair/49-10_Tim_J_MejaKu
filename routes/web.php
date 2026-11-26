<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MejaController;
use App\Http\Middleware\CekRole;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('beranda');
});

// Hanya untuk yang BELUM login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Hanya untuk yang SUDAH login
Route::middleware('auth')->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/beranda', function () {
        return view('beranda');
    })->name('beranda');

    // Fitur Master Meja: hanya admin, kasir, waiter (chef dapat 403)
    Route::middleware(CekRole::class . ':admin,kasir,waiter')->group(function () {
        Route::resource('meja', MejaController::class)
            ->except(['show'])
            ->parameters(['meja' => 'meja']);
    });
});