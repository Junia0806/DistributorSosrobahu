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
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $rokokAgens = BarangAgen::orderBy('id_master_barang', 'desc')->paginate(10);
        foreach ($rokokAgens as $barangAgen) {
            // Get the id_master_barang for the current BarangAgen item
            $namaProduk = $barangAgen->id_master_barang;

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
        return view('agen.pengaturanHarga', compact('rokokAgens','namaRokokList'));
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
