<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\OrderSaleController;
use App\Http\Controllers\Sales\DaftarTokoController;
use App\Http\Controllers\Sales\KunjunganTokoController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\BarangAgenController;
use App\Http\Controllers\OrderSalesController;

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

//CRUD TOKO [sales]
Route::post('/tokoSales', [DaftarTokoController::class, 'store'])->name('tokoSales.store');
Route::get('/tokoSales', [DaftarTokoController::class, 'index'])->name('tokoSales');
Route::get('daftar_toko/{id_daftar_toko}/toko', [DaftarTokoController::class, 'showToko'])->name('toko');
Route::delete('/tokoSales/delete/{id_daftar_toko}', [DaftarTokoController::class, 'destroy'])->name('tokoSales.destroy');
Route::put('/tokoSales/update/{id_daftar_toko}', [DaftarTokoController::class, 'update'])->name('tokoSales.update');

//CRUD KUNJUNGAN TOKO [sales]
Route::get('/kunjunganToko/{id_daftar_toko}', [KunjunganTokoController::class, 'index'])->name('kunjunganToko');
Route::post('/kunjunganToko/{id_daftar_toko}', [KunjunganTokoController::class, 'store'])->name('kunjunganToko.store');
Route::put('/kunjunganToko/update/{id_kunjungan_toko}', [KunjunganTokoController::class, 'update'])->name('kunjunganToko.update');
Route::delete('/kunjunganToko/delete/{id_kunjungan_toko}', [KunjunganTokoController::class, 'destroy'])->name('kunjunganToko.destroy');


Route::get('/pesan', function () {
    return view('sales.pesan');
})->name('pesan');;

Route::get('/detail', function () {
    return view('sales.detailpesan');
})->name('detail');

// Rute untuk memilih barang
Route::get('/sales/pesan_barang', [BarangAgenController::class, 'index'])->name('pesan_barang');

// Rute untuk detail pesanan
Route::post('/sales/detail_pesanan', [OrderSaleController::class, 'detail'])->name('detail_pesanan');

// Rute untuk menyimpan pesanan
Route::post('/sales/submit-pesanan', [OrderSaleController::class, 'submit'])->name('submit-pesanan');


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
