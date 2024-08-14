<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('sales.dashboard');
})->name('dashboard');;

Route::get('/toko', function () {
    return view('sales.toko');
})->name('toko');;

Route::get('/kunjungan/{storeName}', function ($storeName) {
    return view('sales.kunjungan', ['storeName' => $storeName]);
});

Route::get('/pesan', function () {
    return view('sales.pesan');
})->name('pesan');;

Route::get('/detail', function () {
    return view('sales.detailpesan');
})->name('detail');


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


