<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BarangDistributor;
class HargaDistributorController extends Controller
{
    public function index()
    {   
        $namaRokokList = [];
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $rokokDistributors = BarangDistributor::orderBy('id_master_barang', 'desc')->paginate(10);
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
        // return view('agen.pengaturanHarga', compact('rokokDistributors','namaRokokList'));
        return response()->json([$rokokDistributors,$namaRokokList]);
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
