<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/app', function () {
    return view('app');
});

Route::get('/default', function () {
    return view('sales.default');
});

Route::get('/pesan', function () {
    return view('sales.pesan');
})->name('pesan');
;

Route::get('/detail', function () {
    return view('sales.detailpesan');
})->name('detail');


Route::get('/riwayat', function () {
    return view('sales.riwayat');
})->name('riwayat');

Route::get('/nota', function () {
    return view('sales.nota');
})->name('nota');

