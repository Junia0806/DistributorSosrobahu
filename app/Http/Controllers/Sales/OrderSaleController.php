<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\BarangAgen;
use App\Models\OrderSale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OrderSaleController extends Controller
{
    /**
     * Function untuk Menampilkan semua Order dari database
     */
    public function index()
    {
        $orderSales = OrderSale::all();
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
        $request->validate([
            'id_user_sales' => 'required|integer',
            'jumlah' => 'required|integer',
            'total' => 'required|integer',
            'tanggal' => 'required|date',
            'bukti_transfer' => 'required|string',
            'status_pemesanan' => 'required|integer',
            'nota' => 'required|string',
        ]);

        OrderSale::create($request->all());

        return redirect()->route('order_sales.index')
                         ->with('success', 'Order Sale created successfully.');
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
        
        // Ambil detail pesanan berdasarkan ID produk yang dipilih
        $orders = BarangAgen::whereIn('id_master_barang', $selectedProductIds)->get();
        
        // Menghitung total harga
        $totalAmount = $orders->sum(function($order) {
            return $order->harga_agen * $order->jumlah; // Menghitung total harga untuk semua barang
        });


        // Mengambil harga per produk
        $prices = $orders->pluck('harga_agen', 'id_master_barang')->toArray();

        return view('sales.detail_pesanan', compact('orders', 'totalAmount', 'prices'));
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
