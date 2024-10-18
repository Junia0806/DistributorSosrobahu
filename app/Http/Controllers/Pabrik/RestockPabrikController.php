<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\RestockPabrik;
use App\Models\RestockDetailPabrik;
use App\Models\MasterBarang;

class RestockPabrikController extends Controller
{
    // Fitur Riwayat Pabrik
    public function index()
    {
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $restockPabriks = RestockPabrik::orderBy('id_restock', 'desc')->paginate(5);

        // Mengonversi tanggal ke format Carbon
        foreach ($restockPabriks as $restockPabrik) {
            $restockPabrik->tanggal = Carbon::parse($restockPabrik->tanggal);
        }

        // Mengirim data pesanan ke view
        // return view('agen.riwayatAgen', compact('restockPabriks'));

        // Menampilkan data menggunakan json
        return response()->json($restockPabriks);
    }

    public function notaPabrik($idNota)
    {
        // Ganti dengan ID order yang ingin dicari
        $restockDetailPabrik = RestockDetailPabrik::where('id_restock', $idNota)->first();
        $restockDetailPabrikItem = RestockDetailPabrik::where('id_restock', $idNota)->get();
        $restockPabrik = RestockPabrik::where('id_restock', $idNota)->first();
        $namaPabrik = DB::table('user_pabrik')->where('id_user_pabrik', $restockDetailPabrik->id_user_pabrik)->first();
        



        $itemNota = [];
        $nama_rokok = [];

        foreach ($restockDetailPabrikItem as $barangPabrik) {
            $product = DB::table('master_barang')->where('id_master_barang', $barangPabrik->id_master_barang)->first();
            if ($product) { // Cek apakah product ada dan memiliki properti nama_rokok
                $nama_rokok[] = $product->nama_rokok;
                $jumlah_item[] = $barangPabrik->jumlah_produk;
            } else {
                $nama_rokok[] = null; // Jika tidak ditemukan
                $jumlah_item[] = null; // Jika tidak ditemukan
            }

            $itemNota[] = [
                'nama_rokok' => end($nama_rokok), // Gunakan end() untuk mengambil elemen terakhir
                'jumlah_item' => end($jumlah_item),
            ];
        }


        $notaPabrik = [
            'tanggal' => $restockPabrik->tanggal,
            'id_restock' => $restockPabrik->id_restock,
            'nama_pabrik' => $namaPabrik->nama_lengkap,
            'total_item' => $restockPabrik->jumlah,
            'item_nota' => $itemNota
        ];


        // Menampilkan Hasil nota format view
        // return view('agen.nota', compact('notaPabrik'));

        //Menampilkan hasil nota format json
        return response()->json($notaPabrik);
    }

    // Fitur Restock Pabrik

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
        $restocks = MasterBarang::whereIn('id_master_barang', $selectedProductIds)->get();


        // return view('agen.detailPesanan', compact('restocks', 'namaRokokList'));
    }

    public function store(Request $request)
    {
        //ambil data semua buat data untuk tabel order lalu generate id order terbaru lalu jalankan foreach

        // Calculate total price
        // Memasukkan data kedalan tabel Order DIstributor
        $restocks = [
            'id_user_pabrik' => 1,
            'jumlah' => $request->total_items,
            'tanggal' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Memasukan data Ke dalam tabel Detail Order Sales
        RestockPabrik::insert($restocks);
        $id_restock = RestockPabrik::latest('id_restock')->first()->id_restock;
        $restocks = [];
        foreach ($request->input('quantities') as $productId => $quantity) {
            $totalAmount = 0;
            $product = DB::table('master_barang')->where('id_master_barang', $productId)->first();
            $totalAmount += $product->harga_karton_pabrik * $quantity;


            $restocks[] = [
                'id_restock' => $id_restock,
                'id_user_pabrik' => 1,
                'id_master_barang' => $productId,
                'jumlah_produk' => $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Memasukan data Ke dalam tabel Order Detail Sales
        RestockDetailPabrik::insert($restocks);

        // Redirect or return a response
        // return redirect()->route('riwayatDistributor')->with('success', 'Pesanan berhasil dikirim!');
    }
}
