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
use App\Http\Controllers\Pabrik\AkunDistributorController;
use App\Http\Controllers\Pabrik\PesananMasukPabrikController;
use App\Http\Controllers\Pabrik\RestockPabrikController;
use App\Http\Controllers\Pabrik\LoginPabrikController;
use App\Http\Controllers\Pabrik\HargaPabrikController;
use App\Http\Controllers\Pabrik\PengaturanBankPabrikController;
use App\Http\Controllers\Pabrik\OmsetPabrikController;
use App\Http\Controllers\BarangDistributorController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\BarangAgenController;
use App\Http\Controllers\BarangPabrikController;
use App\Http\Controllers\OrderSalesController;
use App\Models\OrderDistributor;

// Rute login dan logout tanpa middleware
Route::get('/sales/halamanLogin', [LoginSalesController::class, 'showLoginForm'])->name('halamanLoginSales');
Route::post('/sales/login', [LoginSalesController::class, 'loginSales'])->name('loginSales');
Route::get('/sales/logout', [LoginSalesController::class, 'logoutSales'])->name('logoutSales');


// Rute lainnya menggunakan middleware
Route::middleware('auth.sales')->group(function () {

    // DASHBOARD SALES
    Route::get('/dashboard', [OrderSaleController::class, 'dashboard'])->name('dashboard');
    Route::get('/sales/update-ranking', [LoginSalesController::class, 'updateRanking'])->name('sales.updateRanking');


    // TOKO SALES
    Route::post('/tokoSales', [DaftarTokoController::class, 'store'])->name('tokoSales.store');
    Route::get('/tokoSales', [DaftarTokoController::class, 'index'])->name('tokoSales');
    Route::get('daftar_toko/{id_daftar_toko}/toko', [DaftarTokoController::class, 'showToko'])->name('toko');
    Route::delete('/tokoSales/delete/{id_daftar_toko}', [DaftarTokoController::class, 'destroy'])->name('tokoSales.destroy');
    Route::put('/tokoSales/update/{id_daftar_toko}', [DaftarTokoController::class, 'update'])->name('tokoSales.update');

    // KUNJUNGAN TOKO
    Route::get('/kunjunganToko/{id_daftar_toko}', [KunjunganTokoController::class, 'index'])->name('kunjunganToko');
    Route::post('/kunjunganToko/{id_daftar_toko}', [KunjunganTokoController::class, 'store'])->name('kunjunganToko.store');
    Route::put('/kunjunganToko/update/{id_kunjungan_toko}', [KunjunganTokoController::class, 'update'])->name('kunjunganToko.update');
    Route::delete('/kunjunganToko/delete/{id_kunjungan_toko}', [KunjunganTokoController::class, 'destroy'])->name('kunjunganToko.destroy');

    // ORDER SALES
    Route::get('/sales/pesan_barang', [BarangAgenController::class, 'index'])->name('pesan_barang');
    Route::post('/sales/detail_pesanan', [OrderSaleController::class, 'detail'])->name('detail_pesanan');

    // RIWAYAT SALES
    Route::post('/sales/riwayatOrder', [OrderSaleController::class, 'store'])->name('simpan_order');
    Route::get('/riwayatOrder', [OrderSaleController::class, 'index'])->name('riwayatOrder');
    // NOTA SALES
    Route::get('order_sales/{id_daftar_toko}/nota', [OrderSaleController::class, 'showNota'])->name('nota');
    Route::get('/sales/nota/{idNota}', [OrderSaleController::class, 'notaSales'])->name('nota_sales');
    Route::get('/sales/bayar/{idNota}', [OrderSaleController::class, 'showBayar'])->name('bayar');
    Route::put('/sales/bayar/{idNota}', [OrderSaleController::class, 'update'])->name('bayar_nota');

    Route::resource('order_sales', OrderSaleController::class);
});


// Rute login dan logout tanpa middleware
Route::get('/agen/halamanLogin', [LoginAgenController::class, 'showLoginForm'])->name('halamanLoginAgen');
Route::post('/agen/login', [LoginAgenController::class, 'loginAgen'])->name('loginAgen');
Route::get('/agen/logout', [LoginAgenController::class, 'logoutAgen'])->name('logoutAgen');

Route::middleware('auth.agen')->group(function () {
    // DASHBOARD AGEN
    Route::get('/dashboard-agen', [BarangAgenController::class, 'stockbarang'])->name('dashboard-agen');

    // PENGATURAN AKUN SALES
    Route::get('/pengaturan-sales', [AkunSalesController::class, 'index'])->name('pengaturanSales');
    Route::put('/pengaturan-sales/update/{id}', [AkunSalesController::class, 'update'])->name('pengaturanSales.update');
    Route::post('/pengaturan-sales/input', [AkunSalesController::class, 'store'])->name('pengaturanSales.input');
    Route::delete('/pengaturan-sales/delete/{id_user_sales}', [AkunSalesController::class, 'destroy'])->name('pengaturanSales.delete');

    // PESANAN MASUK 
    Route::get('/agen/pesananMasuk', [PesananMasukAgenController::class, 'index'])->name('pesananMasuk');
    Route::get('/agen/detailPesanMasuk/{idPesanan}', [PesananMasukAgenController::class, 'detailPesanMasuk'])->name('detailPesanMasuk');
    // Rute untuk menampilkan form edit status
    Route::get('/pesan-masuk/edit-status/{id}', [PesananMasukAgenController::class, 'editStatus'])->name('editStatusPesanan');
    // Rute untuk memproses pembaruan status
    Route::put('/pesan-masuk/update-status/{id}', [PesananMasukAgenController::class, 'updateStatus'])->name('updateStatusPesanan');

    // ORDER AGEN
    Route::get('/agen/pesanBarang', [BarangDistributorController::class, 'index'])->name('pesanBarang');
    Route::post('/agen/detailPesanan', [OrderAgenController::class, 'detail'])->name('detailPesanan');

    // RIWAYAT AGEN 
    Route::get('/riwayatAgen', [OrderAgenController::class, 'index'])->name('riwayatAgen');
    Route::post('riwayatAgen', [OrderAgenController::class, 'store'])->name('simpanOrder');

    // NOTA AGEN
    Route::get('/agen/nota/{idNota}', [OrderAgenController::class, 'notaAgen'])->name('notaAgen');

    // KELOLA HARGA AGEN
    Route::get('/agen/pengaturan-harga', [HargaAgenController::class, 'index'])->name('pengaturanHarga');
    Route::put('/agen/pengaturan-harga/update/{id}', [HargaAgenController::class, 'update'])->name('pengaturanHarga.update');

    // REKENING AGEN
    Route::get('/agen/pengaturan-bank', [PengaturanBankController::class, 'index'])->name('pengaturanBank');
    Route::put('/agen/pengaturan-bank/update', [PengaturanBankController::class, 'update'])->name('rekeningBank.update');
});

// Rute login dan logout tanpa middleware
Route::get('/distributor/halamanLogin', [LoginDistributorController::class, 'showLoginForm'])->name('halamanLoginDistributor');
Route::post('/distributor/login', [LoginDistributorController::class, 'loginDistributor'])->name('loginDistributor');
Route::get('/distributor/logout', [LoginDistributorController::class, 'logoutDistributor'])->name('logoutDistributor');

Route::middleware('auth.distributor')->group(function () {

    // DASHBOARD DISTRIBUTOR
    Route::get('/distributor/dashboard', [BarangDistributorController::class, 'stockbarang'])->name('dashboard-distributor');

    // PENGATURAN AKUN AGEN
    Route::get('/pengaturan-agen', [AkunAgenController::class, 'index'])->name('pengaturanAgen');
    Route::put('/pengaturan-agen/update/{id}', [AkunAgenController::class, 'update'])->name('pengaturanAgen.update');
    Route::post('/pengaturan-agen/input', [AkunAgenController::class, 'store'])->name('pengaturanAgen.input');
    Route::delete('/pengaturan-agen/delete/{id_user_Agen}', [AkunAgenController::class, 'destroy'])->name('pengaturanAgen.delete');

    // PESANAN MASUK 
    Route::get('/distributor/pesananMasuk', [PesananMasukDistributorController::class, 'index'])->name('pesananMasukDistributor');
    Route::get('/distributor/detailPesanMasuk/{idPesanan}', [PesananMasukDistributorController::class, 'detailPesanMasuk'])->name('detailPesanMasukDistributor');
    // Rute untuk menampilkan form edit status
    Route::get('/distributor/pesan-masuk/edit-status/{id}', [PesananMasukDistributorController::class, 'editStatus'])->name('editStatusPesananDistributor');
    // Rute untuk memproses pembaruan status
    Route::put('/distributor/pesan-masuk/update-status/{id}', [PesananMasukDistributorController::class, 'updateStatus'])->name('updateStatusPesananDistributor');


    // ORDER DISTRIBUTOR
    Route::get('/distributor/pesanBarang', [BarangPabrikController::class, 'index'])->name('pesanBarangDistributor');
    Route::post('/distributor/detailPesanan', [OrderDistributorController::class, 'detail'])->name('detailPesananDistributor');

    // RIWAYAT DISTRIBUTOR 
    Route::post('/distributor/riwayatDistributor', [OrderDistributorController::class, 'store'])->name('riwayatDistributor.store');
    Route::get('/distributor/riwayatDistributor', [OrderDistributorController::class, 'index'])->name('riwayatDistributor');

    // NOTA DISTRIBUTOR
    Route::get('/distributor/nota/{idNota}', [OrderDistributorController::class, 'notaDistributor'])->name('notaDistributor');


    // KELOLA HARGA DISTRIBUTOR
    Route::get('/distributor/pengaturan-harga', [HargaDistributorController::class, 'index'])->name('pengaturanHargaDistributor');
    Route::put('/distributor/pengaturan-harga/update/{id}', [HargaDistributorController::class, 'update'])->name('pengaturanHargaDistributor.update');

    // REKENING DISTRIBUTOR
    Route::get('/distributor/pengaturan-bank', [PengaturanBankDistributorController::class, 'index'])->name('pengaturanBankDistributor');
    Route::put('/distributor/pengaturan-bank/update', [PengaturanBankDistributorController::class, 'update'])->name('rekeningBankDistributor.update');
});

// Rute login dan logout tanpa middleware
Route::get('/pabrik/halamanLogin', [LoginPabrikController::class, 'showLoginForm'])->name('halamanLoginPabrik');
Route::post('/pabrik/login', [LoginPabrikController::class, 'loginPabrik'])->name('loginPabrik');
Route::get('/pabrik/logout', [LoginPabrikController::class, 'logoutPabrik'])->name('logoutPabrik');

Route::middleware('auth.pabrik')->group(function () {

    // DASHBOARD PABRIK
    Route::get('/pabrik/dashboard-pabrik', [BarangPabrikController::class, 'stockbarang'])->name('dashboard-pabrik');

    // PENGATURAN AKUN DISTRIBUTOR
    Route::get('/pabrik/pengaturan-distributor', [AkunDistributorController::class, 'index'])->name('pengaturanDistributor');
    Route::put('/pabrik/pengaturan-Distributor/update/{id}', [AkunDistributorController::class, 'update'])->name('pengaturanDistributor.update');
    Route::post('/pabrik/pengaturan-distributor/input', [AkunDistributorController::class, 'store'])->name('pengaturanDistributor.input');
    Route::delete('/pabrik/pengaturan-distributor/delete/{id_user_distributor}', [AkunDistributorController::class, 'destroy'])->name('pengaturanDistributor.delete');

    // PESANAN MASUK 
    Route::get('/pabrik/pesananMasuk', [PesananMasukPabrikController::class, 'index'])->name('pesananMasukPabrik');
    Route::get('/pabrik/detailPesanMasuk/{idPesanan}', [PesananMasukPabrikController::class, 'detailPesanMasuk'])->name('detailPesanMasukPabriik');
    // Rute untuk menampilkan form edit status
    Route::get('/pabrik/pesan-masuk/edit-status/{id}', [PesananMasukPabrikController::class, 'editStatus'])->name('editStatusPesananPabrik');
    // Rute untuk memproses pembaruan status
    Route::put('/pabrik/pesan-masuk/update-status/{id}', [PesananMasukPabrikController::class, 'updateStatus'])->name('updateStatusPesananPabrik');

    // RESTOCK PABRIK
    Route::get('/pabrik/restockBarang', [BarangPabrikController::class, 'index'])->name('restockBarang');

    // RIWAYAT RESTOCK PABRIK 
    Route::get('/pabrik/riwayatPabrik', [RestockPabrikController::class, 'index'])->name('riwayatPabrik');

    // NOTA RESTOCK PABRIK
    Route::get('/pabrik/nota/{idNota}', [RestockPabrikController::class, 'notaPabrik'])->name('notaPabrik');


    // KELOLA HARGA PABRIK
    Route::get('/pabrik/pengaturan-harga', [HargaPabrikController::class, 'index'])->name('pengaturanHargaPabrik');
    Route::put('/pabrik/pengaturan-harga/update/{id}', [HargaPabrikController::class, 'update'])->name('pengaturanHargaPabrik.update');
    Route::delete('/pabrik/pengaturan-harga/delete/{id_master_barang}', [HargaPabrikController::class, 'destroy'])->name('pengaturanHargaPabrik.delete');

    // REKENING PABRIK
    Route::get('/pabrik/pengaturan-bank', [PengaturanBankPabrikController::class, 'index'])->name('pengaturanBankPabrik');
    Route::put('/pabrik/pengaturan-bank/update', [PengaturanBankPabrikController::class, 'update'])->name('rekeningBankPabrik.update');
});

Route::get('/pabrik/dashboard', function () {
    return view('pabrik.dashboard');
})->name('dashboard-pabrik');


Route::get('/pabrik/distributor', function () {
    return view('pabrik.kelola-akun');
})->name('kelola-distributor-pabrik');



Route::get('/pabrik/laporan', function () {
    return view('pabrik.laporan');
})->name('laporan-pabrik');
Route::get('/pabrik/omset-pabrik', [OmsetPabrikController::class, 'omset'])->name('omsetPabrik');

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

