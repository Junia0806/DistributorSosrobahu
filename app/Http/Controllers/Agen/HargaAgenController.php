<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BarangAgen;
use App\Models\MasterBarang;

class HargaAgenController extends Controller
{
    public function index()
    {
        $namaRokokList = [];

        // Dapatkan id_user_agen dari sesi
        $id_user_agen = session('id_user_agen');

        // Query BarangAgen untuk agen tertentu dan urutkan berdasarkan id_master_barang (desc)
        $rokokAgens = BarangAgen::where('id_user_agen', $id_user_agen)
            ->orderBy('id_master_barang', 'desc')
            ->paginate(10);

        // Ambil semua id_master_barang untuk id_user_agen tertentu
        $existingProductIds = BarangAgen::where('id_user_agen', $id_user_agen)
            ->pluck('id_master_barang')
            ->toArray();

        // Hitung jumlah produk baru yang tidak ada di BarangAgen
        $newProductsCount = MasterBarang::whereNotIn('id_master_barang', $existingProductIds)->count();

        // Dapatkan nama rokok dari tabel master_barang untuk setiap id_master_barang
        foreach ($rokokAgens as $barangAgen) {
            $orderValue = MasterBarang::where('id_master_barang', $barangAgen->id_master_barang)->first();
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
            } else {
                $namaRokokList[] = null; // Jika tidak ditemukan, tambahkan nilai null
            }
        }
        return view('agen.pengaturanHarga', compact('rokokAgens', 'namaRokokList', 'newProductsCount'));
    }


    public function showAddProduct()
    {
        // Ambil id_user_agen dari sesi
        $id_user_agen = session('id_user_agen');

        // Ambil id_master_barang yang sudah dimiliki agen tertentu
        $existingProductIds = BarangAgen::where('id_user_agen', $id_user_agen)
            ->pluck('id_master_barang')
            ->toArray();

        // Ambil produk baru yang belum dimiliki agen tertentu
        $newAgenProducts = MasterBarang::whereNotIn('id_master_barang', $existingProductIds)->get();

        // Tampilkan data ke view
        return view('agen.produkBaru', compact('newAgenProducts'));
    }

    public function storeSelectedProducts(Request $request)
    {
        $id_user_agen = session('id_user_agen');

        foreach ($request->products as $productId) {
            $product = MasterBarang::find($productId);

            if ($product) {
                BarangAgen::create([
                    'id_master_barang' => $productId,
                    'id_user_agen' => $id_user_agen,
                    'harga_agen' => $product->harga_karton_pabrik, // Gunakan harga yang sudah ada
                    'stok_karton' => 10,
                ]);
            }
        }

        return redirect()->route('pengaturanHarga')->with('success', 'Produk berhasil ditambahkan');
    }




    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // 'harga_agen' => 'required|string|max:255'
        ]);

        // Mengambil data sales berdasarkan ID
        $setting = BarangAgen::find($id);

        // Jika data sales tidak ditemukan
        if (!$setting) {
            return redirect()->route('pengaturanHarga')->with('error', 'Akun sales tidak ditemukan.');
        }

        // Mengupdate data sales
        $setting->harga_agen = $request->harga_agen;

        // dd($setting);
        // Menyimpan perubahan
        $setting->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pengaturanHarga')->with('success', 'Akun sales berhasil diperbarui.');
    }
}
