<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\MasterBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BarangDistributor;

class HargaDistributorController extends Controller
{
    public function index()
    {
        $id_user_distributor = session('id_user_distributor');
        $namaRokokList = [];
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $rokokDistributors = BarangDistributor::where('id_user_distributor', $id_user_distributor)->get();

        foreach ($rokokDistributors as $barangDistributor) {
            // Get the id_master_barang for the current Barang Distributor item
            $namaProduk = $barangDistributor->id_master_barang;

            // Query the master_barang table for the corresponding record
            $orderValue = DB::table('master_barang')->where('id_master_barang', $namaProduk)->first();

            // Store the nama_rokok in the array
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
            } else {
                $namaRokokList[] = null; // If no matching record is found
            }
        }
        // Mengambil total penjualan untuk setiap sales
        return view('distributor.pengaturanHarga', compact('rokokDistributors', 'namaRokokList'));
        //return response()->json([$rokokDistributors,$namaRokokList]);
    }

    public function showAddProduct()
    {
        $newDistributorProducts = MasterBarang::all();
        $namaRokokList = [];
        $gambarRokokList = [];

        // Loop through each BarangPabrik item
        foreach ($newDistributorProducts as $newDistributorProduct) {
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


        // Pass both newDistributorProducts and namaRokokList to the view
        return view('distributor.produkBaru', compact('newDistributorProducts', 'namaRokokList', 'gambarRokokList'));
        // return response()->json([$barangPabriks,$namaRokokList,$gambarRokokList]);
    }

    public function storeSelectedProducts(Request $request)
    {
        $id_user_distributor = session('id_user_distributor');

        foreach ($request->products as $productId) {
            $product = MasterBarang::find($productId);

            if ($product) {
                BarangDistributor::create([
                    'id_master_barang' => $productId,
                    'id_user_distributor' => $id_user_distributor,
                    'harga_distributor' => $product->harga_karton_pabrik, // Gunakan harga yang sudah ada
                    'stok_karton' => 10,
                ]);
            }
        }

        return redirect()->route('pengaturanHargaDistributor')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // 'harga_distributor' => 'required|string|max:255'
        ]);


        $setting = BarangDistributor::find($id);


        if (!$setting) {
            return redirect()->route('pengaturanHargaDistributor')->with('error', 'Akun sales tidak ditemukan.');
        }


        $setting->harga_distributor = $request->harga_distributor;

        // dd($setting);
        // Menyimpan perubahan
        $setting->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pengaturanHargaDistributor')->with('success', 'Akun sales berhasil diperbarui.');
    }
}
