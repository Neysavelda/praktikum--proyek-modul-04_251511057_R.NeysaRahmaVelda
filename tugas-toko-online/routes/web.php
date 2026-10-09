<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokoController;
use Illuminate\Support\Facades\Auth;

Route::get('/', [TokoController::class, 'index']);
Route::get('/login', [TokoController::class, 'loginForm'])->name('login');
Route::post('/login', [TokoController::class, 'loginProcess']);
Route::post('/logout', [TokoController::class, 'logout']);

Route::get('/tambah-keranjang/{id}', [TokoController::class, 'tambahKeranjang']);
Route::get('/keranjang', [TokoController::class, 'keranjang']);
Route::post('/ubah-keranjang/{id}', [TokoController::class, 'ubahKeranjang']);
Route::get('/hapus-keranjang/{id}', [TokoController::class, 'hapusKeranjang']);

Route::post('/checkout', [TokoController::class, 'checkout']);
Route::get('/pesanan', [TokoController::class, 'riwayatPesanan']);

Route::get('/cek-login', function () {
    return [
        'authenticated' => Auth::check(),
        'user' => Auth::user()?->username,
        'session_id' => session()->getId(),
    ];
});