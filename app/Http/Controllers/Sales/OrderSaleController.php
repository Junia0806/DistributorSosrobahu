<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\BarangAgen;
use App\Models\DaftarToko;
use App\Models\OrderSale;
use Illuminate\Http\Request;
use App\Models\OrderDetailSales;
use App\Models\KunjunganToko;
use Carbon\Carbon;

class OrderSaleController extends Controller
{

    public function dashboard()
{
    // Mengambil data total harga dari semua pemesanan
    $orderSales = OrderSale::all();
    $totalPrice = $orderSales->sum('total');

    // Mengambil jumlah toko dari model
    $jumlahToko = DaftarToko::count();

    // Mengambil produk terlaris
    $topProduct = OrderDetailSales::select('id_master_barang', DB::raw('SUM(jumlah_produk) as total_quantity'))
        ->groupBy('id_master_barang')
        ->orderBy('total_quantity', 'desc')
        ->first();

    // Jika ada produk terlaris
    $topProductName = $topProduct ? DB::table('master_barang')->where('id_master_barang', $topProduct->id_master_barang)->value('nama_rokok') : 'Tidak ada data';

     // Menghitung total stok (dalam pcs)
     $totalStok = OrderDetailSales::sum(DB::raw('jumlah_produk * 10')); // Mengonversi slop ke pcs
     $totalPenjualan = KunjunganToko::sum('sisa_produk'); // Total produk yang terjual
     $totalStok -= $totalPenjualan; // Mengurangi stok berdasarkan produk yang terjual
     
    // Mengirimkan variabel ke view
    return view('sales.dashboard', compact('totalPrice', 'jumlahToko', 'topProductName', 'totalStok'));
}

    /**
     * Function untuk Menampilkan semua Order dari database
     */
    public function index()
    {
        // Membuat pagination dari order paling terbaru
        $orderSales = OrderSale::orderBy('tanggal', 'desc')->paginate(10);

        foreach ($orderSales as $orderSale) {
            $orderSale->tanggal = Carbon::parse($orderSale->tanggal);
        }
        return view('sales.riwayatOrder', compact('orderSales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('order_sales.create');
    }

    /**
     * Function untuk input ke database
     */
    public function store(Request $request)
    {
       
        // Validate the request
        // $validatedData = $request->validate([
        //     'payment-proof' => 'required|file|mimes:jpeg,png,pdf|max:2048',
        //     'quantities' => 'required|array',
        //     'quantities.*' => 'required|integer|min:1',
        // ]);
       
        // Handle file upload
        if ($request->hasFile('payment_proof')) {
            $path = $request->file('payment_proof')->store('bukti_transfer', 'public');
        }
        
        //ambil data semua buat data untuk tabel order lalu generate id order terbaru lalu jalankan foreach
        // Calculate total price
        $totalAmount = 0;

        $orders = [
            'id_user_sales' => 1,
            'jumlah' => $request->total_items,
            'total' => $request->total_amount,
            'tanggal' => now(),
            'bukti_transfer' => $path ?? '',
            'status_pemesanan' => 0, // Assuming 0 means "Pending"
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Memasukan data Ke dalam tabel Order Sales
        OrderSale::insert($orders);
        $id_order = OrderSale::latest('id_order')->first()->id_order;
        $orders = [];
        foreach ($request->input('quantities') as $productId => $quantity) {
            $product = DB::table('tbl_barang_agen')->where('id_master_barang', $productId)->first();
            $totalAmount += $product->harga_agen * $quantity;
            

            $orders[] = [
                'id_order'=> $id_order,
                'id_user_agen' => 1,
                'id_user_sales' => 1,
                'id_master_barang' => $productId,
                'id_barang_agen' => $product->id_barang_agen,
                'jumlah_produk' => $quantity,
                'jumlah_harga_item' => $totalAmount,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            
        }
        
        // Memasukan data Ke dalam tabel Order Detail Sales
        OrderDetailSales::insert($orders);

        // Redirect or return a response
        return redirect()->route('riwayatOrder')->with('success', 'Pesanan berhasil dikirim!');
    }



    /**
     * Menampilkan Order Berdasarkan id pada database
     */
    public function show($id)
    {
        $orderSale = OrderSale::find($id);
        return view('order_sales.show', compact('orderSale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $orderSale = OrderSale::find($id);
        return view('sales.riwayat', compact('orderSale'));
    }

    // Menampilkan nota Berdasarkan id order
    public function showNota($id_order)
    {
        $orderSale = OrderSale::findOrFail($id_order);

        // Logika untuk menampilkan nota pesanan
        return view('order_sales.nota', compact('orderSale'));
    }

    /**
     * Function untuk Mengupdate ke database 
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user_sales' => 'required|integer',
            'jumlah' => 'required|integer',
            'total' => 'required|integer',
            'tanggal' => 'required|date',
            'bukti_transfer' => 'required|string',
            'status_pemesanan' => 'required|integer',
            'nota' => 'required|string',
        ]);

        $orderSale = OrderSale::find($id);
        $orderSale->update($request->all());

        return redirect()->route('order_sales.index')
            ->with('success', 'Order Sale updated successfully.');
    }

    /**
     * Function untuk Menghapus atau delete ke database
     */
    public function destroy($id)
    {
        $orderSale = OrderSale::find($id);
        $orderSale->delete();

        return redirect()->route('order_sales.index')
            ->with('success', 'Order Sale deleted successfully.');
    }

    //  memilih barang Dihalaman Order 
    public function detail(Request $request)
    {
        $selectedProductIds = $request->input('products', []); // Mengambil ID produk yang dipilih dari request
        $namaRokokList = [];

        // Loop through each selected product ID
        foreach ($selectedProductIds as $barangAgen) {

            // Convert the ID to an integer
            $namaProdukint = intval($barangAgen);

            // Query the master_barang table for the corresponding record
            $program = DB::table('master_barang')->where('id_master_barang', $namaProdukint)->first();

            // Store the nama_rokok in the array
            if ($program) {
                $namaRokokList[] = $program->nama_rokok;
            } else {
                $namaRokokList[] = null; // If no matching record is found
            }
        }
        
        // Ambil detail pesanan berdasarkan ID produk yang dipilih
        $orders = BarangAgen::whereIn('id_master_barang', $selectedProductIds)->get();

        // Menghitung total harga
        $totalAmount = $orders->sum(function ($order) {
            return $order->harga_agen * $order->jumlah; // Menghitung total harga untuk semua barang
        });


        // Mengambil harga per produk
        $prices = $orders->pluck('harga_agen', 'id_master_barang')->toArray();

        return view('sales.detail_pesanan', compact('orders', 'totalAmount', 'prices','namaRokokList'));
    }


    public function submit(Request $request)
    {
        $request->validate([
            'products' => 'required|array', // Validasi ID produk yang dipilih
            'payment-proof' => 'required|file|mimes:jpeg,png,pdf|max:2048' // Validasi file bukti pembayaran
        ]);

        // Proses upload bukti pembayaran
        $filePath = $request->file('payment-proof')->store('public/payment_proofs');

        // Simpan data pesanan ke database (contoh sederhana, sesuaikan dengan struktur data dan kebutuhan aplikasi)
        // Misalnya, Anda perlu membuat model Order dan menyimpan data pesanan ke dalamnya

        // Redirect dengan pesan sukses
        return redirect()->route('detail')->with('success', 'Pesanan Anda telah diproses. Terima kasih!');
    }
}
