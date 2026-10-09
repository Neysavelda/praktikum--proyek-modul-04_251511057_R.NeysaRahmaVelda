<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KeranjangController::class, 'index']);
Route::get('/index', [KeranjangController::class, 'index']);
Route::get('/tambah/{id}', [KeranjangController::class, 'tambah']);
Route::get('/keranjang', [KeranjangController::class, 'keranjang']);
Route::post('/ubah/{id}', [KeranjangController::class, 'ubah']);
Route::get('/hapus/{id}', [KeranjangController::class, 'hapus']);
Route::get('/kosongkan', [KeranjangController::class, 'kosongkan']);