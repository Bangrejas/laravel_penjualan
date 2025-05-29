<?php

use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');

// barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

// // CRUD Penjualan
// Route::resource('penjualan', PenjualanController::class);

// // API barang (untuk auto-isi data barang)
// Route::get('/api/barang/{kode}', [BarangController::class, 'show']);

// // Export CSV & Print Preview
// Route::get('/penjualan/{id}/csv', [PenjualanController::class, 'exportCSV'])->name('penjualan.csv');
// Route::get('/penjualan/{id}/print', [PenjualanController::class, 'print'])->name('penjualan.print');

// // Route Pencarian Barang
// Route::get('/barang/search', [App\Http\Controllers\BarangController::class, 'search']);


