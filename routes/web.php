<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sales\OrderSaleController;
use App\Http\Controllers\Sales\DaftarTokoController;
use App\Http\Controllers\Sales\KunjunganTokoController;
use App\Http\Controllers\Sales\LoginSalesController;
use App\Http\Controllers\Agen\OrderAgenController;
use App\Http\Controllers\Agen\PesananMasukAgenController;
use App\Http\Controllers\Agen\AkunSalesController;
use App\Http\Controllers\Agen\HargaAgenController;
use App\Http\Controllers\Agen\PengaturanBankController;
use App\Http\Controllers\Agen\LoginAgenController;
use App\Http\Controllers\Distributor\OrderDistributorController;
use App\Http\Controllers\Distributor\HargaDistributorController;
use App\Http\Controllers\Distributor\AkunAgenController;
use App\Http\Controllers\Distributor\LoginDistributorController;
use App\Http\Controllers\Distributor\PengaturanBankDistributorController;
use App\Http\Controllers\Distributor\PesananMasukDistributorController;
use App\Http\Controllers\BarangDistributorController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\BarangAgenController;
use App\Http\Controllers\BarangPabrikController;
use App\Http\Controllers\OrderSalesController;
use App\Models\OrderDistributor;

// Route::get('/', function () {
//     return view('sales.login');
// });

// Route::post('/', function () {
//     $username = request('username');
//     $password = request('password');

//     $validUsername = 'sales';
//     $validPassword = '123';

//     if ($username === $validUsername && $password === $validPassword) {
//         return redirect('/dashboard');
//     } else {
//         return redirect('/')->with('error', 'Username atau password salah');
//     }
// });

Route::get('/sales/halamanLogin', [LoginSalesController::class, 'showLoginForm'])->name('halamanLogin');
Route::post('/sales/login', [LoginSalesController::class, 'loginSales'])->name('loginSales');
Route::post('/sales/logout', [LoginSalesController::class, 'logoutSales'])->name('logoutSales');

Route::get('/sales/update-ranking', [LoginSalesController::class, 'updateRanking'])->name('sales.updateRanking');


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
Route::get('/dashboard-agen', [BarangAgenController::class, 'stockbarang'])->name('dashboard-agen');
Route::get('/agen/pesan', function () {
    return view('agen.pesan');
})->name('agen-pesan');
Route::get('/agen/pesanBarang', [BarangDistributorController::class, 'index'])->name('pesanBarang');
Route::post('/agen/detailPesanan', [OrderAgenController::class, 'detail'])->name('detailPesanan');

Route::get('/pengaturan-sales', [AkunSalesController::class, 'index'])->name('pengaturanSales');


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
Route::get('/agen/pengaturan-bank', [PengaturanBankController::class, 'index'])->name('pengaturanBank');
Route::put('/agen/pengaturan-bank/update', [PengaturanBankController::class, 'update'])->name('rekeningBank.update');


// Pengaturan Harga Agen
Route::get('/agen/pengaturan', function () {
    return view('agen.pengaturan_harga');
})->name('agen-pengaturan');
Route::get('/agen/pengaturan-harga', [HargaAgenController::class, 'index'])->name('pengaturanHarga');
Route::put('/agen/pengaturan-harga/update/{id}', [HargaAgenController::class, 'update'])->name('pengaturanHarga.update');

// Pengaturan Akun Sales
Route::get('/agen/kelola-sales', function () {
    return view('agen.kelola-akun');
})->name('kelola-sales');
Route::get('/pengaturan-sales', [AkunSalesController::class, 'index'])->name('pengaturanSales');
Route::put('/pengaturan-sales/update/{id}', [AkunSalesController::class, 'update'])->name('pengaturanSales.update');
Route::post('/pengaturan-sales/input', [AkunSalesController::class, 'store'])->name('pengaturanSales.input');
Route::delete('/pengaturan-sales/delete/{id_user_sales}', [AkunSalesController::class, 'destroy'])->name('pengaturanSales.delete');


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


// Route::get('/login-agen', function () {
//     return view('agen.login-agen');
// })->name('login');

// Route::post('/login-agen', function () {
//     $username = request('username');
//     $password = request('password');

//     if ($username === 'agen' && $password === '456') {
//         return redirect()->route('dashboard-agen');
//     }

//     return redirect()->route('agen.login-agen')->withErrors('Username atau Password salah.');
// })->name('login.submit');
Route::get('/agen/halamanLogin', [LoginAgenController::class, 'showLoginForm'])->name('halamanLogin');
Route::post('/agen/login', [LoginAgenController::class, 'loginAgen'])->name('loginAgen');
Route::post('/agen/logout', [LoginAgenController::class, 'logoutAgen'])->name('logoutAgen');



// //DISTRIBUTOR
// Route::get('/distributor/login', function () {
//     return view('distributor.login');
// })->name('login-distributor');

// Route::post('/distributor/login', function () {
//     $username = request('username');
//     $password = request('password');

//     if ($username === 'distributor' && $password === '789') {
//         return redirect()->route('dashboard-distributor');
//     }

//     return redirect()->route('login-distributor')->withErrors(['login' => 'Username atau password salah.']);
// })->name('login-post');

Route::get('/distributor/dashboard', function () {
    return view('distributor.dashboard');
})->name('dashboard-distributor');
Route::get('/distributor/dashboard-distributor', [BarangDistributorController::class, 'stockbarang'])->name('dashboard-distributor');
Route::get('/distributor/halamanLogin', [LoginDistributorController::class, 'showLoginForm'])->name('halamanLogin');
Route::post('/distributor/login', [LoginDistributorController::class, 'loginDistributor'])->name('loginDistributor');
Route::post('/distributor/logout', [LoginDistributorController::class, 'logoutDistributor'])->name('logoutDistributor');


Route::get('/pengaturan-agen', [AkunAgenController::class, 'index'])->name('pengaturanAgen');
// Buat view untuk Akun agen nya dahulu lalu aktifkan route nya
Route::put('/pengaturan-agen/update/{id}', [AkunAgenController::class, 'update'])->name('pengaturanAgen.update');
Route::post('/pengaturan-agen/input', [AkunAgenController::class, 'store'])->name('pengaturanAgen.input');
Route::delete('/pengaturan-agen/delete/{id_user_Agen}', [AkunAgenController::class, 'destroy'])->name('pengaturanAgen.delete');

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
Route::get('/distributor/pesanBarang', [BarangPabrikController::class, 'index'])->name('pesanBarangDistributor');
// Masih Error karena belum ada view pesan barang buat view pesan barang dahulu
// Route::post('/distributor/detailPesanan', [OrderDistributorController::class, 'detail'])->name('detailPesananDistributor');


Route::get('/distributor/pesananMasuk', [PesananMasukDistributorController::class, 'index'])->name('pesananMasukDistributor');
Route::get('/distributor/detailPesanMasuk/{idPesanan}', [PesananMasukDistributorController::class, 'detailPesanMasuk'])->name('detailPesanMasukDistributor');
// Rute untuk menampilkan form edit status
Route::get('/distributor/pesan-masuk/edit-status/{id}', [PesananMasukDistributorController::class, 'editStatus'])->name('editStatusPesananDistributor');
// Rute untuk memproses pembaruan status
Route::put('/distributor/pesan-masuk/update-status/{id}', [PesananMasukDistributorController::class, 'updateStatus'])->name('updateStatusPesananDistributor');

Route::get('/distributor/riwayat', function () {
    return view('distributor.riwayat');
})->name('distributor-riwayat');
Route::get('/distributor/riwayatDistributor', [OrderDistributorController::class, 'index'])->name('riwayatDistributor');
Route::get('/distributor/nota/{idNota}', [OrderDistributorController::class, 'notaDistributor'])->name('notaDistributor');

Route::get('/distributor/nota', function () {
    return view('distributor.nota');
})->name('distributor-nota');

Route::get('/distributor/pengaturan-harga', function () {
    return view('distributor.pengaturan-harga');
})->name('distributor-pengaturan-harga');
Route::get('/distributor/pengaturan-harga', [HargaDistributorController::class, 'index'])->name('pengaturanHargaDistributor');
// Masih Error buat view pengaturan harga terlebih dahulu
// Route::put('/distributor/pengaturan-harga/update/{id}', [HargaDistributorController::class, 'update'])->name('pengaturanHargaDistributor.update');

Route::get('/distributor/rekening', function () {
    return view('distributor.rekening');
})->name('distributor-rekening');
Route::get('/distributor/pengaturan-bank', [PengaturanBankController::class, 'index'])->name('pengaturanBankDistributor');
Route::put('/distributor/pengaturan-bank/update', [PengaturanBankController::class, 'update'])->name('rekeningBankDIstributor.update');
Route::get('/distributor/pengaturan-bank/{idUser}', [PengaturanBankDistributorController::class, 'index'])->name('pengaturanBankDistributor');

// pabrik
Route::get('/pabrik/login', function () {
    return view('pabrik.login');
})->name('login-pabrik');

Route::post('/pabrik/login', function () {
    $username = request('username');
    $password = request('password');

    if ($username === 'pabrik' && $password === '123') {
        return redirect()->route('dashboard-pabrik');
    }

    return redirect()->route('login-pabrik')->withErrors(['login' => 'Username atau password salah.']);
})->name('login-post');

Route::get('/pabrik/dashboard', function () {
    return view('pabrik.dashboard');
})->name('dashboard-pabrik');

Route::get('/pabrik/distributor', function () {
    return view('pabrik.kelola-akun');
})->name('kelola-distributor-pabrik');

Route::get('/pabrik/laporan', function () {
    return view('pabrik.laporan');
})->name('laporan-pabrik');

Route::get('/pabrik/detail-laporan', function () {
    return view('pabrik.detail-laporan');
})->name('detailLaporan-pabrik');

Route::get('/pabrik/pesanan-masuk', function () {
    return view('pabrik.transaksi');
})->name('pabrik-transaksi');

Route::get('/pabrik/pesanan-masuk/detail', function () {
    $namaDistributor = request('namaDistributor');
    $orderDate = request('orderDate');

    return view('pabrik.detail-transaksi', [
        'namaDistributor' => $namaDistributor,
        'orderDate' => $orderDate,
    ]);
})->name('pabrik-detail-transaksi');

Route::get('/pabrik/restock', function () {
    return view('pabrik.restock');
})->name('pabrik-restock');

Route::get('/pabrik/detailrestock', function () {
    return view('pabrik.detail-restock');
})->name('pabrik-detailrestock');

Route::get('/pabrik/riwayat-restock', function () {
    return view('pabrik.riwayat-restock');
})->name('pabrik-riwayat-restock');


Route::get('/pabrik/riwayat/detail', function () {
    $namaDistributor = request('namaDistributor');
    $orderDate = request('orderDate');

    return view('pabrik.detail-riwayat', [
        'namaDistributor' => $namaDistributor,
        'orderDate' => $orderDate,
    ]);
})->name('pabrik-detail-riwayat');

Route::get('/pabrik/kelola-produk', function () {
    return view('pabrik.kelola-produk');
})->name('pabrik-kelola-produk');

Route::get('/pabrik/rekening', function () {
    return view('pabrik.rekening');
})->name('pabrik-rekening');

