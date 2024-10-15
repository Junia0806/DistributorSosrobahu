<?php

namespace App\Http\Controllers;

use App\Models\BarangDistributor;
use Illuminate\Http\Request;
use App\Models\MasterBarang;
use App\Models\OrderDetailDistributor;
use App\Models\OrderDistributor;
use Illuminate\Support\Facades\DB;

class BarangDistributorController extends Controller
{
    public function index()
    {
        $barangDistributors = BarangDistributor::all();
        $namaRokokList = [];
        $gambarRokokList = [];

        // Loop through each BarangDistributor item
        foreach ($barangDistributors as $barangDistributor) {
            // Get the id_master_barang for the current BarangDistributor item
            $namaProduk = $barangDistributor->id_master_barang;

            // Query the master_barang table for the corresponding record
            $orderValue = DB::table('master_barang')->where('id_master_barang', $namaProduk)->first();

            // Store the nama_rokok in the array
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
                $gambarRokokList[] = $orderValue->gambar;
            } else {
                $namaRokokList[] = null; // If no matching record is found
                $gambarRokokList[] = null;
            }
        }

        

        // menampilkan hasil dalam format view
        return view('agen.pesanBarang', compact('barangDistributors', 'namaRokokList','gambarRokokList'));

        // Menampilkan hasil dalam format json
        // return response()->json([$barangDistributors,$namaRokokList,$gambarRokokList]);
    }

    public function stockbarang()
    {
        // Ambil semua barang agen
        $barangDistributors = BarangDistributor::all();
        
        // Siapkan array untuk menyimpan data
        $namaRokokList = [];
        $gambarRokokList = [];
        $totalProdukList = []; 
        
        // Loop untuk setiap barang agen
        foreach ($barangDistributors as $barangDistributor) {
            $idMasterBarang = $barangDistributor->id_master_barang;
            $idUserDistributor = $barangDistributor->id_user_distributor;
        
            // Ambil data dari master_barang berdasarkan id_master_barang
            $orderValue = DB::table('master_barang')->where('id_master_barang', $idMasterBarang)->first();
        
            // Hitung total jumlah produk berdasarkan id_master_barang, id_user_distributor, dan status_pemesanan dari order_detail_distributor
            $totalProduk = DB::table('order_detail_distributor')
                ->join('order_distributor', 'order_detail_distributor.id_order', '=', 'order_distributor.id_order')
                ->where('order_detail_distributor.id_master_barang', $idMasterBarang)
                ->where('order_detail_distributor.id_user_distributor', $idUserDistributor)
                ->where('order_distributor.status_pemesanan', 1)
                ->sum('order_detail_distributor.jumlah_produk');
        
            // Hitung total produk terjual berdasarkan id_master_barang, id_user_distributor, dan status_pemesanan dari order_detail_agen
            $totalProdukTerjual = DB::table('order_detail_agen')
                ->join('order_agen', 'order_detail_agen.id_order', '=', 'order_agen.id_order')
                ->where('order_detail_agen.id_master_barang', $idMasterBarang)
                ->where('order_detail_agen.id_user_distributor', $idUserDistributor)
                ->where('order_agen.status_pemesanan', 1)
                ->sum('order_detail_agen.jumlah_produk');
    
            // Simpan data ke dalam array
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
                $gambarRokokList[] = $orderValue->gambar;
                $totalProdukList[] = $totalProduk - $totalProdukTerjual; 
            } else {
                $namaRokokList[] = null; 
                $gambarRokokList[] = null;
                $totalProdukList[] = 0 ; 
            }
        }
        

        // Mengambil semua pesanan yang statusnya selesai
        $completedOrders = OrderDistributor::where('status_pemesanan', 1)->get();

        // Mengambil detail pesanan
        $orderDetails = OrderDetailDistributor::whereIn('id_order', $completedOrders->pluck('id_order'))->get();

        $totalStockKarton = $orderDetails->sum('jumlah_produk'); // Karton

        // Pesanan masuk (yang sudah berhasil)
        $incomingCompletedOrders = DB::table('order_detail_agen')
            ->join('order_agen', 'order_agen.id_order', '=', 'order_detail_agen.id_order')
            ->where('order_agen.status_pemesanan', 1)
            ->sum('order_detail_agen.jumlah_produk'); 

        // Hitung stok yang disesuaikan (dikurangi pesanan masuk yang sudah berhasil)
        $finalStockKarton = $totalStockKarton - $incomingCompletedOrders;


        // Produk terlaris dari pesanan sales yang statusnya 1
        $topProduct = DB::table('order_detail_agen')
            ->join('order_agen', 'order_agen.id_order', '=', 'order_detail_agen.id_order')
            ->where('order_agen.status_pemesanan', 1) // Status pesanan sales yang selesai
            ->select('order_detail_agen.id_master_barang', DB::raw('SUM(order_detail_agen.jumlah_produk) as total_jumlah'))
            ->groupBy('order_detail_agen.id_master_barang')
            ->orderBy('total_jumlah', 'desc')
            ->first();

        $topProductName = $topProduct ? DB::table('master_barang')
            ->where('id_master_barang', $topProduct->id_master_barang)
            ->value('nama_rokok') : 'Tidak ada data';

        // Total pendapatan dari pesanan agen yang statusnya 1
        $totalPendapatan = DB::table('order_agen')
            ->where('status_pemesanan', 1)
            ->sum('total');

        // Mengambil jumlah sales dari tabel user_agen
        $totalAgen = DB::table('user_agen')->count();

        // Kirim data ke view
        return view('distributor.dashboard', [
            'barangDistributors' => $barangDistributors,
            'namaRokokList' => $namaRokokList,
            'gambarRokokList' => $gambarRokokList,
            'totalProdukList' => $totalProdukList,
            'finalStockKarton' => $finalStockKarton,
            'totalPendapatan' => $totalPendapatan,
            'topProductName' => $topProductName,
            'totalAgen' => $totalAgen,
        ]);

        // return response()->json([
        //     $barangDistributors,
        //     $namaRokokList,
        //     $gambarRokokList,
        //     $totalProdukList,
        //     $finalStockKarton,
        //     $totalPendapatan,
        //     $topProductName,
        //     $totalAgen
        // ]);
        
    }
}
