<?php

use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/create', [PenjualanController::class, 'create'])->name('penjualan.create');
Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');

// barang
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');

// customer
Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');

// dijual
Route::get('/dijual', [App\Http\Controllers\DijualController::class, 'index'])->name('dijual.index');
Route::get('/dijual/create', [App\Http\Controllers\DijualController::class, 'create'])->name('dijual.create');
Route::post('/dijual', [App\Http\Controllers\DijualController::class, 'store'])->name('dijual.store');


// // CRUD Penjualan
// Route::resource('penjualan', PenjualanController::class);

// // API barang (untuk auto-isi data barang)
// Route::get('/api/barang/{kode}', [BarangController::class, 'show']);

// // Export CSV & Print Preview
// Route::get('/penjualan/{id}/csv', [PenjualanController::class, 'exportCSV'])->name('penjualan.csv');
// Route::get('/penjualan/{id}/print', [PenjualanController::class, 'print'])->name('penjualan.print');

// // Route Pencarian Barang
// Route::get('/barang/search', [App\Http\Controllers\BarangController::class, 'search']);


