<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\OrderSaleController;
use App\Http\Controllers\Sales\DaftarTokoController;
use App\Http\Controllers\Sales\KunjunganTokoController;
use App\Http\Controllers\Agen\OrderAgenController;
use App\Http\Controllers\Agen\PesananMasukAgenController;
use App\Http\Controllers\Agen\AkunSalesController;
use App\Http\Controllers\Agen\HargaAgenController;
use App\Http\Controllers\Agen\PengaturanBankController;
use App\Http\Controllers\BarangDistributorController;
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

// Rute untuk memilih barang
Route::get('/sales/pesan_barang', [BarangAgenController::class, 'index'])->name('pesan_barang');
Route::post('/sales/detail_pesanan', [OrderSaleController::class, 'detail'])->name('detail_pesanan');
// Rute untuk menyimpan pesanan
Route::post('/sales/riwayatOrder', [OrderSaleController::class, 'store'])->name('simpan_order');
// Route untuk menampilkan riwayat pemesanan
Route::get('/riwayatOrder', [OrderSaleController::class, 'index'])->name('riwayatOrder');
// Route untuk menampilkan nota berdasarkan id_daftar_toko
Route::get('order_sales/{id_daftar_toko}/nota', [OrderSaleController::class, 'showNota'])->name('nota');

Route::get('/nota', function () {
    return view('sales.nota');
})->name('nota');
Route::get('/sales/nota/{idNota}', [OrderSaleController::class, 'notaSales'])->name('nota_sales');
Route::get('/sales/bayar/{idNota}', [OrderSaleController::class, 'showBayar'])->name('bayar');
Route::put('/sales/bayar/{idNota}', [OrderSaleController::class, 'update'])->name('bayar_nota');


Route::get('/edit', function () {
    return view('sales.edit_pesanan');
})->name('edit');


//DASHBOARD SALES
Route::get('/dashboard', [OrderSaleController::class, 'dashboard'])->name('dashboard');


//ROUTE AGEN
Route::get('/dashboar-agen', [BarangAgenController::class, 'stockbarang'])->name('dashboard-agen');
Route::get('/agen/pesan', function () {
    return view('agen.pesan');
})->name('agen-pesan');
Route::get('/agen/pesanBarang', [BarangDistributorController::class, 'index'])->name('pesanBarang');
Route::post('/agen/detailPesanan', [OrderAgenController::class, 'detail'])->name('detailPesanan');


// Rute untuk menyimpan pesanan
Route::post('riwayatAgen', [OrderAgenController::class, 'store'])->name('simpanOrder');

Route::get('/agen/detailpesan', function () {
    return view('agen.detailpesan');
})->name('agen-detailpesan');

Route::get('/agen/riwayat', function () {
    return view('agen.riwayat');
})->name('agen-riwayat');
//Menampilkan Riwayat Agen
Route::get('/riwayatAgen', [OrderAgenController::class, 'index'])->name('riwayatAgen');

Route::get('/agen/nota', function () {
    return view('agen.nota');
})->name('agen-nota');
Route::get('/agen/nota/{idNota}', [OrderAgenController::class, 'notaAgen'])->name('notaAgen');

// Pengaturan Rekening Agen
Route::get('/agen/rekening', function () {
    return view('agen.rekening');
})->name('agen-rekening');
Route::get('/pengaturan-bank/{idUser}', [PengaturanBankController::class, 'index'])->name('pengaturanBank');
Route::put('/pengaturan-bank/{idUser}', [PengaturanBankController::class, 'update'])->name('rekeningBank.update');

// Pengaturan Harga Agen
Route::get('/agen/pengaturan', function () {
    return view('agen.pengaturan_harga');
})->name('agen-pengaturan');
Route::get('/pengaturan-harga', [HargaAgenController::class, 'index'])->name('pengaturanHarga');
Route::put('/pengaturan-harga/update/{id}', [HargaAgenController::class, 'update'])->name('pengaturanHarga.update');

// Pengaturan Akun Sales
Route::get('/agen/kelola-sales', function () {
    return view('agen.kelola-akun');
})->name('kelola-sales');
Route::get('/pengaturan-sales', [AkunSalesController::class, 'index'])->name('pengaturanSales');
Route::put('/pengaturan-sales/update/{id}', [AkunSalesController::class, 'update'])->name('pengaturanSales.update');
Route::post('/pengaturan-sales/input', [AkunSalesController::class, 'store'])->name('pengaturanSales.input');


Route::get('/agen/pesananMasuk', [PesananMasukAgenController::class, 'index'])->name('pesananMasuk');
Route::get('/agen/detailPesanMasuk/{idPesanan}', [PesananMasukAgenController::class, 'detailPesanMasuk'])->name('detailPesanMasuk');
// Rute untuk menampilkan form edit status
Route::get('/pesan-masuk/edit-status/{id}', [PesananMasukAgenController::class, 'editStatus'])->name('editStatusPesanan');
// Rute untuk memproses pembaruan status
Route::put('/pesan-masuk/update-status/{id}', [PesananMasukAgenController::class, 'updateStatus'])->name('updateStatusPesanan');


Route::get('/detail', function () {
    $namaAgen = request('namaAgen');
    $orderDate = request('orderDate');

    return view('agen.detail-transaksi', [
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



//DISTRIBUTOR
Route::get('/distributor/login', function () {
    return view('distributor.login');
})->name('login-distributor');

Route::post('/distributor/login', function () {
    $username = request('username');
    $password = request('password');

    if ($username === 'distributor' && $password === '789') {
        return redirect()->route('dashboard-distributor');
    }

    return redirect()->route('login-distributor')->withErrors(['login' => 'Username atau password salah.']);
})->name('login-post');

Route::get('/distributor/dashboard', function () {
    return view('distributor.dashboard');
})->name('dashboard-distributor');

Route::get('/distributor/kelola-agen', function () {
    return view('distributor.kelola-agen');
})->name('kelola-agen');

Route::get('/distributor/transaksi', function () {
    return view('distributor.transaksi');
})->name('distributor-transaksi');

Route::get('/transaksi/detail', function () {
    $namaAgen = request('namaAgen');
    $orderDate = request('orderDate');

    return view('distributor.detail-transaksi', [
        'namaAgen' => $namaAgen,
        'orderDate' => $orderDate,
    ]);
})->name('detail.transaksi');

Route::get('/transaksi/detail/{namaAgen}', function ($namaAgen) {
    return view('distributor.detail-transaksi', ['namaAgen' => $namaAgen]);
});


Route::get('/distributor/pesan', function () {
    return view('distributor.pesan');
})->name('distributor-pesan');

Route::get('/distributor/detailpesan', function () {
    return view('distributor.detailpesan');
})->name('distributor-detailpesan');

Route::get('/distributor/riwayat', function () {
    return view('distributor.riwayat');
})->name('distributor-riwayat');

Route::get('/distributor/nota', function () {
    return view('distributor.nota');
})->name('distributor-nota');

Route::get('/distributor/pengaturan-harga', function () {
    return view('distributor.pengaturan-harga');
})->name('distributor-pengaturan-harga');

Route::get('/distributor/rekening', function () {
    return view('distributor.rekening');
})->name('distributor-rekening');
