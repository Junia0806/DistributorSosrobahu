<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderSaleController;
use App\Http\Controllers\DaftarTokoController;
use App\Http\Controllers\KunjunganTokoController;

Route::get('/', function () {
    return view('sales.login');
});

Route::post('/', function () {
    $username = request('username');
    $password = request('password');

    $validUsername = 'sales';
    $validPassword = '123';

    if ($username === $validUsername && $password === $validPassword) {
        return redirect('/dashboard');
    } else {
        return redirect('/')->with('error', 'Username atau password salah');
    }
});

// CRUD SAlES
Route::resource('order_sales', OrderSaleController::class);

Route::get('/dashboard', function () {
    return view('sales.dashboard');
})->name('dashboard');;

// Route untuk menampilkan Daftar Toko
Route::get('/tokoSales', [DaftarTokoController::class, 'index'])->name('tokoSales');
// Route untuk menampilkan toko berdasarkan id_daftar_toko
Route::get('daftar_toko/{id_daftar_toko}/toko', [DaftarTokoController::class, 'showToko'])->name('toko');
Route::get('/toko', function () {
    return view('sales.toko');
})->name('toko');;


Route::get('kunjunganToko/{id_daftar_toko}', [KunjunganTokoController::class,'index', 'showVisitsByStore'])->name('kunjunganToko');
Route::get('/kunjungan/{storeName}', function ($storeName) {
    return view('sales.kunjungan', ['storeName' => $storeName]);
});

Route::get('/pesan', function () {
    return view('sales.pesan');
})->name('pesan');;

Route::get('/detail', function () {
    return view('sales.detailpesan');
})->name('detail');


// Route untuk menampilkan riwayat pemesanan
Route::get('/riwayatOrder', [OrderSaleController::class, 'index'])->name('riwayatOrder');
// Route untuk menampilkan nota berdasarkan id_daftar_toko
Route::get('order_sales/{id_daftar_toko}/nota', [OrderSaleController::class, 'showNota'])->name('nota');
Route::get('/riwayat', function () {
    return view('sales.riwayat');
})->name('riwayat');

Route::get('/nota', function () {
    return view('sales.nota');
})->name('nota');


//ROUTE AGEN
Route::get('/default', function () {
    return view('agen.default');
});

Route::get('/agen/pesan', function () {
    return view('agen.pesan');
})->name('agen-pesan');

Route::get('/agen/detailpesan', function () {
    return view('agen.detailpesan');
})->name('agen-detailpesan');

Route::get('/agen/riwayat', function () {
    return view('agen.riwayat');
})->name('agen-riwayat');

Route::get('/agen/nota', function () {
    return view('agen.nota');
})->name('agen-nota');

Route::get('/rekening', function () {
    return view('agen.rekening');
})->name('agen-rekening');

Route::get('/pengaturan', function () {
    return view('agen.pengaturan_harga');
})->name('pengaturan');


