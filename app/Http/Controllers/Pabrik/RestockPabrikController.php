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
    public function index(Request $request)
{
    // Ambil input pencarian
    $search = $request->input('search');

    // Query awal untuk pencarian dengan kondisi sesuai input
    $restockPabriks = RestockPabrik::query();

    if ($search) {
        // Filter data sesuai dengan format yang diinginkan
        $restockPabriks->where(function ($query) use ($search) {
            $query->where(DB::raw("CONCAT('RST1234', id_restock)"), 'like', "%{$search}%")
                ->orWhere(DB::raw("DATE_FORMAT(tanggal, '%d/%m/%Y')"), 'like', "%{$search}%")
                ->orWhere(DB::raw("CONCAT(jumlah, ' Karton')"), 'like', "%{$search}%");
        });
    }

    // Order by dan pagination khusus untuk hasil pencarian
    $restockPabriks = $restockPabriks->orderBy('id_restock', 'desc')->paginate(10)->withQueryString();

     // Mengonversi tanggal ke format Carbon
    foreach ($restockPabriks as $restockPabrik) {
        $restockPabrik->tanggal = Carbon::parse($restockPabrik->tanggal);
    }

    // Mengirim data pesanan ke view
    return view('pabrik.riwayat-restock', compact('restockPabriks'));
    // Menampilkan data menggunakan json
    //return response()->json($restockPabriks);
}

    public function notaPabrik($idNota)
    {
        // Ganti dengan ID order yang ingin dicari
        $restockDetailPabrikItem = RestockDetailPabrik::where('id_restock', $idNota)->get();
        $restockPabrik = RestockPabrik::where('id_restock', $idNota)->first();
        $namaPabrik = DB::table('user_pabrik')->where('id_user_pabrik', $restockPabrik->id_user_pabrik)->first();

        $itemNota = [];
        foreach ($restockDetailPabrikItem as $barangPabrik) {
            $product = DB::table('master_barang')->where('id_master_barang', $barangPabrik->id_master_barang)->first();
            $itemNota[] = [
                'nama_rokok' => $product->nama_rokok ?? null,
                'jumlah_item' => $barangPabrik->jumlah_produk,
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
        return view('pabrik.detail-riwayat', compact('notaPabrik'));

        //Menampilkan hasil nota format json
        //return response()->json($notaPabrik);
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


        return view('pabrik.detail-restock', compact('restocks', 'namaRokokList'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        // Menghitung total jumlah dari semua produk yang direstock
        $totalItems = array_sum($request->quantities);

        // Menyimpan data ke dalam tabel RestockPabrik
        $restockData = [
            'id_user_pabrik' => 1,
            'jumlah' => $totalItems,
            'tanggal' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        // Simpan data RestockPabrik dan ambil ID yang baru
        $restockPabrik = RestockPabrik::create($restockData);
        $id_restock = $restockPabrik->id_restock;

        $restocks = [];
        foreach ($request->input('quantities') as $productId => $quantity) {
            // Pastikan produk ada dalam master_barang
            $product = DB::table('master_barang')->where('id_master_barang', $productId)->first();

            if ($product) {
                $restocks[] = [
                    'id_restock' => $id_restock,
                    'id_user_pabrik' => 1,
                    'id_master_barang' => $productId,
                    'jumlah_produk' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Memasukkan data ke dalam tabel RestockDetailPabrik
        RestockDetailPabrik::insert($restocks);

        // Redirect or return a response
        return redirect()->route('riwayatPabrik')->with('success', 'Pesanan berhasil dikirim!');
    }
}
