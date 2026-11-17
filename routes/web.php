<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DaftarServiceController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\PembayaranController;

Route::get('/', fn () => redirect()->route('pelanggan.index'));

Route::resource('pelanggan', PelangganController::class)->except(['show']);
Route::resource('kendaraan', KendaraanController::class)->except(['show']);
Route::resource('daftar-service', DaftarServiceController::class)
    ->parameters(['daftar-service' => 'daftarService'])->except(['show']);
Route::resource('data-service', DataServiceController::class)
    ->parameters(['data-service' => 'dataService'])->except(['show']);
Route::resource('pembayaran', PembayaranController::class)->except(['show']);
