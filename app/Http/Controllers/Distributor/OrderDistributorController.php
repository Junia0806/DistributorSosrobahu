<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\OrderDistributor;
use App\Models\OrderDetailDistributor;
use App\Models\MasterBarang;


class OrderDistributorController extends Controller
{
    public function dashboardData()
    {
        // Mengambil semua pesanan yang statusnya selesai
        $completedOrders = OrderDistributor::where('status_pemesanan', 1)->get();

        // Mengambil detail pesanan
        $orderDetails = OrderDetailDistributor::whereIn('id_order', $completedOrders->pluck('id_order'))->get();

        // Menghitung total stok (konversi dari karton ke slop, 1 karton = 10 slop)
        $slopPerKarton = 10;
        $totalStockKarton = $orderDetails->sum('jumlah_produk'); // Karton
        $totalStockSlop = $totalStockKarton * $slopPerKarton;

        // Pesanan masuk (yang sudah berhasil)
        $incomingCompletedOrders = DB::table('order_detail_agen')
            ->join('order_agen', 'order_agen.id_order', '=', 'order_detail_agen.id_order')
            ->where('order_agen.status_pemesanan', 1)
            ->sum('order_detail_agen.jumlah_produk'); // Slop

        // Hitung stok yang disesuaikan (dikurangi pesanan masuk yang sudah berhasil)
        $finalStockSlop = $totalStockSlop - $incomingCompletedOrders;

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

        // Total pendapatan dari pesanan sales yang statusnya 1
        $totalPendapatan = DB::table('order_distributor')
            ->where('status_pemesanan', 1)
            ->sum('total');

        // Mengambil jumlah sales dari tabel user_sales
        $totalAgen = DB::table('user_agen')->count();

        // Mengirim data ke view dashboard
        return view('agen.dashboard-agen', [
            'finalStockSlop' => $finalStockSlop,
            'totalPendapatan' => $totalPendapatan,
            'topProductName' => $topProductName,
            'totalSales' => $totalAgen,
        ]);
    }

    public function index()
    {
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $orderDistributors = OrderDistributor::orderBy('id_order', 'desc')->paginate(10);

        // Mengonversi tanggal ke format Carbon
        foreach ($orderDistributors as $orderDistributor) {
            $orderDistributor->tanggal = Carbon::parse($orderDistributor->tanggal);
        }

        // Mengirim data pesanan ke view
        return view('distributor.riwayatDistributor', compact('orderDistributors'));

        // Menampilkan data menggunakan json
        // return response()->json($orderDistributors);
    }

    // Menampilkan detail pada order Distributor
    public function detail(Request $request)
    {
        $selectedProductIds = $request->input('products', []); // Mengambil ID produk yang dipilih dari request
        $namaRokokList = [];

        // Loop through each selected product ID
        foreach ($selectedProductIds as $barangPabrik) {

            // Convert the ID to an integer
            $namaProdukint = intval($barangPabrik);

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
        $orders = MasterBarang::whereIn('id_master_barang', $selectedProductIds)->get();

        // Menghitung total harga
        $totalAmount = $orders->sum(function ($order) {
            return $order->harga_karton_pabrik * $order->jumlah; // Menghitung total harga untuk semua barang
        });


        // Mengambil harga per produk
        $prices = $orders->pluck('harga_karton_pabrik', 'id_master_barang')->toArray();

         return view('distributor.detailpesan', compact('orders', 'totalAmount', 'prices', 'namaRokokList'));
    }

       //Menyimpan Order Distributor
       public function store(Request $request)
       {
           // Handle file upload
           if ($request->hasFile('payment_proof')) {
               $path = $request->file('payment_proof')->store('bukti_transfer', 'public');
           }
   
           //ambil data semua buat data untuk tabel order lalu generate id order terbaru lalu jalankan foreach
   
           // Calculate total price
           $totalAmount = 0;
           // Memasukkan data kedalan tabel Order DIstributor
           $orders = [
               'id_user_distributor' => 6,
               'jumlah' => $request->total_items,
               'total' => $request->total_amount,
               'tanggal' => now(),
               'bukti_transfer' => $path ?? '',
               'status_pemesanan' => 0, // Assuming 0 means "Pending"
               'created_at' => now(),
               'updated_at' => now(),
           ];
   
           // Memasukan data Ke dalam tabel Detail Order Sales
           OrderDistributor::insert($orders);
           $id_order = OrderDistributor::latest('id_order')->first()->id_order;
           $orders = [];
           foreach ($request->input('quantities') as $productId => $quantity) {
               $totalAmount = 0;
               $product = DB::table('master_barang')->where('id_master_barang', $productId)->first();
               $totalAmount += $product->harga_karton_pabrik * $quantity;
   
   
               $orders[] = [
                   'id_order' => $id_order,
                   'id_user_pabrik' => 1,
                   'id_user_distributor' => 6,
                   'id_master_barang' => $productId,
                   'jumlah_produk' => $quantity,
                   'jumlah_harga_item' => $totalAmount,
                   'created_at' => now(),
                   'updated_at' => now(),
               ];
           }
   
           // Memasukan data Ke dalam tabel Order Detail Sales
           OrderDetailDistributor::insert($orders);
   
           // Redirect or return a response
           return redirect()->route('riwayatDistributor')->with('success', 'Pesanan berhasil dikirim!');
       }

    // Menampilkan Nota pada riwayat Distributor
    public function notaDistributor($idNota)
{
    // Ganti dengan ID order yang ingin dicari
    $orderDetailDistributor = OrderDetailDistributor::where('id_order', $idNota)->first();
    $orderDetailDistributorItem = OrderDetailDistributor::where('id_order', $idNota)->get();
    $orderDistributor = OrderDistributor::where('id_order', $idNota)->first();
    $namaPabrik = DB::table('user_pabrik')->where('id_user_pabrik', $orderDetailDistributor->id_user_pabrik)->first();
    $namaDistributor = DB::table('user_distributor')->where('id_user_distributor', $orderDistributor->id_user_distributor)->first();

    $itemNota = [];
    $nama_rokok = [];

    foreach ($orderDetailDistributorItem as $barangDistributor) {
        // Mengambil data dari tabel master_barang, termasuk harga_karton_pabrik
        $product = DB::table('master_barang')->where('id_master_barang', $barangDistributor->id_master_barang)->first();

        if ($product) { // Cek apakah product ada dan memiliki properti nama_rokok
            $nama_rokok[] = $product->nama_rokok;
            $harga_satuan[] = $product->harga_karton_pabrik; // Menggunakan harga_karton_pabrik dari master_barang
            $jumlah_item[] = $barangDistributor->jumlah_produk;
            $jumlah_harga[] = $barangDistributor->jumlah_harga_item;
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

    $notaDistributor = [
        'tanggal' => $orderDistributor->tanggal,
        'id_order' => $orderDistributor->id_order,
        'nama_pabrik' => $namaPabrik->nama_lengkap,
        'nama_distributor' => $namaDistributor->nama_lengkap,
        'no_telp' => $namaDistributor->no_telp,
        'total_item' => $orderDistributor->jumlah,
        'total_harga' => $orderDistributor->total,
        'item_nota' => $itemNota
    ];

    // Menampilkan Hasil nota format view
    return view('distributor.nota', compact('notaDistributor'));

    //Menampilkan hasil nota format json
    // return response()->json($notaDistributor);
}
}