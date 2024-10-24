<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MasterBarang;
use Illuminate\Support\Facades\DB;
use App\Models\RestockDetailPabrik;
use App\Models\OrderDistributor;
use Carbon\Carbon;

class BarangPabrikController extends Controller
{
    public function index()
{
    $barangPabriks = MasterBarang::all();
    $namaRokokList = [];
    $gambarRokokList = [];

    // Loop through each BarangPabrik item
    foreach ($barangPabriks as $barangPabrik) {
        // Get the id_master_barang for the current BarangPabrik item
        $namaProduk = $barangPabrik->id_master_barang;

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


    // Pass both barangPabriks and namaRokokList to the view
    return view('distributor.pesan', compact('barangPabriks', 'namaRokokList', 'gambarRokokList'));
    // return response()->json([$barangPabriks,$namaRokokList,$gambarRokokList]);
    }

    public function stockbarang()
    {
        // Ambil semua barang agen
        $barangPabriks = MasterBarang::all();

        $pesananMasuks = OrderDistributor::orderBy('id_order', 'desc')->get();;
    
    // Mengelompokkan pesanan berdasarkan bulan dan melakukan penotalan omset per bulan
        $pesananPerBulan = $pesananMasuks->groupBy(function($item) {
            // Mengelompokkan berdasarkan bulan dan tahun (misalnya, "2024-10")
            return Carbon::parse($item->tanggal)->format('Y-m');
        })->map(function($group) {
            // Menambahkan total omset untuk setiap kelompok bulan
            return [
                'pesanan' => $group,
                'total_omset' => $group->sum('total'),
            ];
        });
        
        // Siapkan array untuk menyimpan data
        $namaRokokList = [];
        $gambarRokokList = [];
        $totalProdukList = []; 
        
        // Loop untuk setiap barang agen
        foreach ($barangPabriks as $barangPabrik) {
            $idMasterBarang = $barangPabrik->id_master_barang;
            $idUserPabrik = $barangPabrik->id_user_pabrik;
        
            // Ambil data dari master_barang berdasarkan id_master_barang
            $orderValue = DB::table('master_barang')->where('id_master_barang', $idMasterBarang)->first();
        
            // Hitung total jumlah produk berdasarkan id_master_barang, id_user_pabrik, dan status_pemesanan dari restock_detail_pabrik
            $totalProduk = DB::table(table: 'restock_detail_pabrik')
                ->join('restock_pabrik', 'restock_detail_pabrik.id_restock', '=', 'restock_pabrik.id_restock')
                ->where('restock_detail_pabrik.id_master_barang', $idMasterBarang)
                ->where('restock_detail_pabrik.id_user_pabrik', $idUserPabrik)
                ->sum('restock_detail_pabrik.jumlah_produk');
        
            // Hitung total produk terjual berdasarkan id_master_barang, id_user_pabrik, dan status_pemesanan dari order_detail_distributor
            $totalProdukTerjual = DB::table('order_detail_distributor')
                ->join('order_distributor', 'order_detail_distributor.id_order', '=', 'order_distributor.id_order')
                ->where('order_detail_distributor.id_master_barang', $idMasterBarang)
                ->where('order_detail_distributor.id_user_pabrik', $idUserPabrik)
                ->where('order_distributor.status_pemesanan', 1)
                ->sum('order_detail_distributor.jumlah_produk');
    
            // Simpan data ke dalam array
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
                $gambarRokokList[] = $orderValue->gambar;
                $totalProdukList[] = $totalProduk - $totalProdukTerjual; // Perhitungan total produk yang tersedia
            } else {
                $namaRokokList[] = null; 
                $gambarRokokList[] = null;
                $totalProdukList[] = 0 ; 
            }
        }
        

    $slopPerKarton = 10;

    // Menghitung total stok karton dari pesanan yang selesai (tanpa mengambil semua pesanan)
    $totalStockKarton = DB::table('restock_detail_pabrik')
        ->join('order_distributor', 'order_distributor.id_order', '=', 'restock_detail_pabrik.id_restock')
        ->where('order_distributor.status_pemesanan', 1) // Pesanan yang selesai
        ->sum('restock_detail_pabrik.jumlah_produk'); // Jumlah produk dalam karton

    // Konversi stok karton menjadi slop
    $totalStockSlop = $totalStockKarton * $slopPerKarton;

    // Pesanan masuk (yang sudah berhasil) dalam slop
    $incomingCompletedOrders = DB::table('order_detail_distributor')
        ->join('order_distributor', 'order_distributor.id_order', '=', 'order_detail_distributor.id_order')
        ->where('order_distributor.status_pemesanan', 1)
        ->sum('order_detail_distributor.jumlah_produk'); // Jumlah produk dalam slop

    // Hitung stok akhir (stok dikurangi pesanan masuk yang sudah berhasil)
    $finalStockSlop = $totalStockSlop - $incomingCompletedOrders;

    // Produk terlaris dari pesanan yang selesai
    $topProduct = DB::table('order_detail_distributor')
        ->join('order_distributor', 'order_distributor.id_order', '=', 'order_detail_distributor.id_order')
        ->where('order_distributor.status_pemesanan', 1)
        ->select('order_detail_distributor.id_master_barang', DB::raw('SUM(order_detail_distributor.jumlah_produk) as total_jumlah'))
        ->groupBy('order_detail_distributor.id_master_barang')
        ->orderBy('total_jumlah', 'desc')
        ->first();

    // Ambil nama produk terlaris
    $topProductName = $topProduct ? DB::table('master_barang')
        ->where('id_master_barang', $topProduct->id_master_barang)
        ->value('nama_rokok') : 'Tidak ada data';

    // Total pendapatan dari pesanan distributor yang selesai
    $totalPendapatan = DB::table('order_distributor')
        ->where('status_pemesanan', 1)
        ->sum('total');

    // Mengambil jumlah distributor dari tabel user_distributor
    $totalDistributor = DB::table('user_distributor')->count();

        // Kirim data ke view
        // return view('agen.dashboard-agen', [
        //     'barangPabriks' => $barangPabriks,
        //     'namaRokokList' => $namaRokokList,
        //     'gambarRokokList' => $gambarRokokList,
        //     'totalProdukList' => $totalProdukList,
        //     'finalStockSlop' => $finalStockSlop,
        //     'totalPendapatan' => $totalPendapatan,
        //     'topProductName' => $topProductName,
        //     'totalDistributor' => $totalDistributor,
        // ]);

        return response()->json([
            'barang_pabriks' => $barangPabriks,
            'nama_rokok_list' => $namaRokokList,
            'gambar_rokok_list' => $gambarRokokList,
            'total_produk_list' => $totalProdukList,
            'final_stock_slop' => $finalStockSlop,
            'total_pendapatan' => $totalPendapatan,
            'top_product_name' => $topProductName,
            'total_distributor' => $totalDistributor,
            'pesanan_per_bulan' => $pesananPerBulan
        ]);
        
    }
}
