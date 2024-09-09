<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use App\Models\BarangDistributor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OrderAgen;
use App\Models\OrderDetailAgen;

class OrderAgenController extends Controller
{
    public function index()
    {
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $orderAgens = OrderAgen::orderBy('id_order', 'desc')->paginate(10);

        // Mengonversi tanggal ke format Carbon
        foreach ($orderAgens as $orderAgen) {
            $orderAgen->tanggal = Carbon::parse($orderAgen->tanggal);
        }

        // Mengirim data pesanan ke view
        return view('agen.riwayatAgen', compact('orderAgens'));
    }

    //  memanipulasi jumlah barang Dihalaman Order Detail
    public function detail(Request $request)
    {
        $selectedProductIds = $request->input('products', []); // Mengambil ID produk yang dipilih dari request
        $namaRokokList = [];

        // Loop through each selected product ID
        foreach ($selectedProductIds as $barangDistributor) {

            // Convert the ID to an integer
            $namaProdukint = intval($barangDistributor);

            // Query the master_barang table for the corresponding record
            $orderValue = DB::table('master_barang')->where('id_master_barang', $namaProdukint)->first();

            // Store the nama_rokok in the array
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
            } else {
                $namaRokokList[] = null; // If no matching record is found
            }
        }

        // Ambil detail pesanan berdasarkan ID produk yang dipilih
        $orders = BarangDistributor::whereIn('id_master_barang', $selectedProductIds)->get();

        // Menghitung total harga
        $totalAmount = $orders->sum(function ($order) {
            return $order->harga_distributor * $order->jumlah; // Menghitung total harga untuk semua barang
        });


        // Mengambil harga per produk
        $prices = $orders->pluck('harga_distributor', 'id_master_barang')->toArray();

        return view('agen.detailPesanan', compact('orders', 'totalAmount', 'prices', 'namaRokokList'));
    }

    //Menyimpan Order Agen
    public function store(Request $request)
    {
        // Handle file upload
        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('bukti_transfer', 'public');
        }

        //ambil data semua buat data untuk tabel order lalu generate id order terbaru lalu jalankan foreach

        // Calculate total price
        $totalAmount = 0;
        // Memasukkan data kedalan tabel Order Sales
        $orders = [
            'id_user_agen' => 1,
            'jumlah' => $request->total_items,
            'total' => $request->total_amount,
            'tanggal' => now(),
            'bukti_transfer' => $path ?? '',
            'status_pemesanan' => 0, // Assuming 0 means "Pending"
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Memasukan data Ke dalam tabel Detail Order Sales
        OrderAgen::insert($orders);
        $id_order = OrderAgen::latest('id_order')->first()->id_order;
        $orders = [];
        foreach ($request->input('quantities') as $productId => $quantity) {
            $totalAmount = 0;
            $product = DB::table('tbl_barang_disitributor')->where('id_master_barang', $productId)->first();
            $totalAmount += $product->harga_distributor * $quantity;


            $orders[] = [
                'id_order' => $id_order,
                'id_user_distributor' => 6,
                'id_user_agen' => 1,
                'id_master_barang' => $productId,
                'id_barang_distributor' => $product->id_barang_distributor,
                'jumlah_produk' => $quantity,
                'jumlah_harga_item' => $totalAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Memasukan data Ke dalam tabel Order Detail Sales
        OrderDetailAgen::insert($orders);

        // Redirect or return a response
        return redirect()->route('riwayatAgen')->with('success', 'Pesanan berhasil dikirim!');
    }

    public function notaAgen($idNota)  
    {   
        // Ganti dengan ID order yang ingin dicari
        $orderDetailAgen = OrderDetailAgen::where('id_order', $idNota)->first();
        $orderDetailAgenItem = OrderDetailAgen::where('id_order', $idNota)->get();
        $orderAgen = OrderAgen::where('id_order', $idNota)->first();
        $namaDistributor = DB::table('user_distributor')->where('id_user_distributor', $orderDetailAgen->id_user_distributor)->first();
        $namaAgen = DB::table('user_agen')->where('id_user_agen', $orderAgen->id_user_agen)->first();
        

        
        $itemNota = [];
        $nama_rokok = [];

        foreach ($orderDetailAgenItem as $barangAgen) {
            $product = DB::table('master_barang')->where('id_master_barang', $barangAgen->id_master_barang)->first();
            $hargaSatuan = DB::table('tbl_barang_disitributor')->where('id_master_barang', $barangAgen->id_master_barang)->first();
            if ($product) { // Cek apakah product ada dan memiliki properti nama_rokok
                $nama_rokok[] = $product->nama_rokok;
                $harga_satuan[] = $hargaSatuan->harga_distributor;
                $jumlah_item[] = $barangAgen->jumlah_produk;
                $jumlah_harga[] = $barangAgen->jumlah_harga_item;
            } else {
                $nama_rokok[] = null; // Jika tidak ditemukan
                $jumlah_item[] = null; // Jika tidak ditemukan
                $jumlah_harga[] = null; // Jika tidak ditemukan
                $harga_satuan[] = null; // Jika tidak ditemukan
            }
        
            $itemNota[] = [
                'nama_rokok' => end($nama_rokok), // Gunakan end() untuk mengambil elemen terakhir
                'harga_satuan' => end($harga_satuan),
                'jumlah_item' => end($jumlah_item),
                'jumlah_harga' => end($jumlah_harga),
            ];
        }
        
        
        $notaAgen = [
            'tanggal' => $orderAgen->tanggal,
            'id_order' => $orderAgen->id_order,
            'nama_distributor' => $namaDistributor->nama_lengkap,
            'nama_agen' => $namaAgen->nama_lengkap,
            'no_telp' => $namaAgen->no_telp,
            'total_item' => $orderAgen->jumlah,
            'total_harga' => $orderAgen->total,
            'item_nota' => $itemNota
        ];
        

        
        return view('agen.nota', compact('notaAgen'));
    }
}
