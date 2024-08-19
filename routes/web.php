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


//ROUTE AGEN
Route::get('/rekening', function () {
    return view('agen.rekening');
})->name('rekening');


Route::get('/pengaturan', function () {
    return view('agen.pengaturan_harga');
})->name('pengaturan');


Route::get('/kelola-akun', function () {
    return view('agen.kelola-akun');
})->name('kelola');

Route::get('/transaksi', function () {
    return view('agen.transaksi');
})->name('transaksi');

// routes/web.php
Route::get('/detail', function () {
    $namaAgen = request('namaAgen');
    $orderDate = request('orderDate');

    return view('agen.detail', [
        'namaAgen' => $namaAgen,
        'orderDate' => $orderDate,
    ]);
})->name('detail');

Route::get('/detail/{namaAgen}', function ($namaAgen) {
    return view('agen.detail', ['namaAgen' => $namaAgen]);
});


Route::get('/login-agen', function () {
    return view('agen.login-agen');
})->name('login');

Route::post('/login-agen', function () {
    $username = request('username');
    $password = request('password');

    if ($username === 'agen' && $password === '456') {
        return redirect()->route('dashboard-agen');
    }

    return redirect()->route('agen.login-agen')->withErrors('Username atau Password salah.');
})->name('login.submit');

Route::get('/dashboard-agen', function () {
    return view('agen.dashboard-agen');
})->name('dashboard');
