<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;



Route::get('/pengelolaan', [PageController::class, 'pengelolaan'])->name('pengelolaan');


// CRUD Routes
Route::post('/penjualan/store', [PageController::class, 'storePenjualan'])->name('penjualan.store');
Route::put('/penjualan/update/{id}', [PageController::class, 'updatePenjualan'])->name('penjualan.update');
Route::delete('/penjualan/delete/{id}', [PageController::class, 'deletePenjualan'])->name('penjualan.delete');
Route::get('/penjualan/{id}', [PageController::class, 'getPenjualan'])->name('penjualan.get');