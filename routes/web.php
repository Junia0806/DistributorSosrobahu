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

Route::get('/login-sales', function () {
    return view('login-sales');
});

Route::post('/login-sales', function () {
    $username = request('username');
    $password = request('password');

    $validUsername = 'sales';
    $validPassword = '123';

    if ($username === $validUsername && $password === $validPassword) {
        return redirect('/dashboard-sales');
    } else {
        return redirect('/login-sales')->with('error', 'Username atau password salah');
    }
});

Route::get('/dashboard-sales', function () {
    return view('dashboard-sales');
});

Route::get('/daftar-toko-sales', function () {
    return view('daftar-toko-sales');
});

Route::get('/daftar-kunjungan/{storeName}', function ($storeName) {
    return view('daftar-kunjungan-sales', ['storeName' => $storeName]);
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

Route::get('/rekening', function () {
    return view('agen.rekening');
})->name('rekening');


Route::get('/pengaturan', function () {
    return view('agen.pengaturan_harga');
})->name('pengaturan');


