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
        $rokokAgens = BarangAgen::orderBy('id_master_barang', 'desc')->paginate(10);
        $existingProductIds = BarangAgen::pluck('id_master_barang')->toArray();
        $newProductsCount = MasterBarang::whereNotIn('id_master_barang', $existingProductIds)->count();
        foreach ($rokokAgens as $barangAgen) {
            $namaProduk = $barangAgen->id_master_barang;
            $orderValue = DB::table('master_barang')->where('id_master_barang', $namaProduk)->first();
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
            } else {
                $namaRokokList[] = null;
            }
        }
        return view('agen.pengaturanHarga', compact('rokokAgens', 'namaRokokList', 'newProductsCount'));
    }

    public function showAddProduct()
    {
        $existingProductIds = BarangAgen::pluck('id_master_barang')->toArray();
        $newAgenProducts = MasterBarang::whereNotIn('id_master_barang', $existingProductIds)->get();
    
        return view('agen.produkBaru', compact('newAgenProducts'));
    }
    
    public function showAdd()
    {
        $newAgenProducts = MasterBarang::all();
        $namaRokokList = [];
        $gambarRokokList = [];

        // Loop through each BarangPabrik item
        foreach ($newAgenProducts as $newDistributorProduct) {
            // Get the id_master_barang for the current BarangPabrik item
            $namaProduk = $newDistributorProduct->id_master_barang;

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


        // Pass both newAgenProducts and namaRokokList to the view
        return view('agen.produkBaru', compact('newAgenProducts', 'namaRokokList', 'gambarRokokList'));
        // return response()->json([$barangPabriks,$namaRokokList,$gambarRokokList]);
    }

    public function storeSelectedProducts(Request $request)
    {
        $id_user_agen = session('id_user_distributor');

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
