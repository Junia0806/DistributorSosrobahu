<?php

namespace App\Http\Controllers;

use App\Models\BarangAgen;
use App\Models\MasterBarang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangAgenController extends Controller
{

    public function stockbarang()
    {
        // Ambil semua barang agen
        $barangAgens = BarangAgen::all();
        
        // Siapkan array untuk menyimpan data
        $namaRokokList = [];
        $gambarRokokList = [];
        $totalProdukList = []; 
        
        // Loop untuk setiap barang agen
        foreach ($barangAgens as $barangAgen) {
            $idMasterBarang = $barangAgen->id_master_barang;
            $idUserAgen = $barangAgen->id_user_agen;
        
            // Ambil data dari master_barang berdasarkan id_master_barang
            $orderValue = DB::table('master_barang')->where('id_master_barang', $idMasterBarang)->first();
        
            // Hitung total jumlah produk berdasarkan id_master_barang, id_user_agen, dan status_pemesanan dari order_detail_agen
            $totalProduk = DB::table('order_detail_agen')
                ->join('order_agen', 'order_detail_agen.id_order', '=', 'order_agen.id_order')
                ->where('order_detail_agen.id_master_barang', $idMasterBarang)
                ->where('order_detail_agen.id_user_agen', $idUserAgen)
                ->where('order_agen.status_pemesanan', 1)
                ->sum('order_detail_agen.jumlah_produk');
        
            // Hitung total produk terjual berdasarkan id_master_barang, id_user_agen, dan status_pemesanan dari order_detail_sales
            $totalProdukTerjual = DB::table('order_detail_sales')
                ->join('order_sales', 'order_detail_sales.id_order', '=', 'order_sales.id_order')
                ->where('order_detail_sales.id_master_barang', $idMasterBarang)
                ->where('order_detail_sales.id_user_agen', $idUserAgen)
                ->where('order_sales.status_pemesanan', 1)
                ->sum('order_detail_sales.jumlah_produk');
    
            // Simpan data ke dalam array
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
                $gambarRokokList[] = $orderValue->gambar;
                $totalProdukList[] = ($totalProduk * 10) - $totalProdukTerjual; // Perhitungan total produk yang tersedia
            } else {
                $namaRokokList[] = null; 
                $gambarRokokList[] = null;
                $totalProdukList[] = 0 ; 
            }
        }
        
        // Kirim data ke view
        return view('agen.dashboard-agen', compact('barangAgens', 'namaRokokList', 'gambarRokokList', 'totalProdukList'));
    }
    
    //Menampilkan semua barang pada order sales
    public function index()
    {
        $barangAgens = BarangAgen::all();
        $namaRokokList = [];
        $gambarRokokList = [];

        // Loop through each BarangAgen item
        foreach ($barangAgens as $barangAgen) {
            // Get the id_master_barang for the current BarangAgen item
            $namaProduk = $barangAgen->id_master_barang;

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



        // Pass both barangAgens and namaRokokList to the view
        return view('sales.pesan_barang', compact('barangAgens', 'namaRokokList', 'gambarRokokList'));
    }


    public function create()
    {
        return view('barang_agen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_master_barang' => 'required|integer',
            'id_user_agen' => 'required|integer',
            'harga_agen' => 'required|integer',
            'stok_karton' => 'required|integer',
        ]);

        BarangAgen::create($request->all());

        return redirect()->route('barang_agen.index')->with('success', 'Barang Agen berhasil ditambahkan.');
    }

    public function show($id)
    {
        $barangAgen = BarangAgen::findOrFail($id);
        return view('barang_agen.show', compact('barangAgen'));
    }

    public function edit($id)
    {
        $barangAgen = BarangAgen::findOrFail($id);
        return view('barang_agen.edit', compact('barangAgen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_master_barang' => 'required|integer',
            'id_user_agen' => 'required|integer',
            'harga_agen' => 'required|integer',
            'stok_karton' => 'required|integer',
        ]);

        $barangAgen = BarangAgen::findOrFail($id);
        $barangAgen->update($request->all());

        return redirect()->route('barang_agen.index')->with('success', 'Barang Agen berhasil diperbarui.');
    }



    public function destroy($id)
    {
        BarangAgen::findOrFail($id)->delete();
        return redirect()->route('barang_agen.index')->with('success', 'Barang Agen berhasil dihapus.');
    }
}
