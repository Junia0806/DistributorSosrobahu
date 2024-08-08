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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/app', function () {
    return view('app');
});

// login sales
Route::get('/login-sales', function () {
    return view('login-sales');
})->name('login.sales');

// dashboard sales
Route::get('/dashboard-sales', function () {
    return view('dashboard-sales');
})->name('dashboard.sales');

// login <-> dashboard
Route::post('/login', function () {
    return redirect()->route('dashboard.sales');
})->name('login');

// daftar kunjungan <-> tambah kunjungan 
Route::view('/daftar-kunjungan-sales', 'daftar-kunjungan-sales')->name('daftarKunjunganSales');
Route::view('/tambah-kunjungan-sales', 'tambah-kunjungan-sales')->name('tambahKunjunganSales');

// daftar toko <-> tambah toko
Route::view('/daftar-toko-sales', 'daftar-toko-sales')->name('daftarTokoSales');
Route::view('/tambah-toko-sales', 'tambah-toko-sales')->name('tambahTokoSales');

// detail toko
Route::view('/daftar-toko-sales', 'daftar-toko-sales')->name('daftarTokoSales');
Route::view('/tambah-toko-sales', 'tambah-toko-sales')->name('tambahTokoSales');
Route::get('/detail-toko/{id}', function ($id) {
    $store = [
        'id' => $id,
        'name' => 'Toko Berkah',
        'location' => 'Seoul',
        'owner' => 'Subin',
        'phone' => '267543',
        'products' => 20,
        'description' => 'Deskripsi Toko.',
        'opening_hours' => '08:00 - 20:00',
    ];
    return view('detail-toko-sales', ['store' => $store]);
})->name('detailTokoSales');