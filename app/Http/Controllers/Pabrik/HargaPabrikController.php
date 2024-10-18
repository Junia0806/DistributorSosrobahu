<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MasterBarang;

class HargaPabrikController extends Controller
{
    public function index()
    {   
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $rokokPabriks = MasterBarang::orderBy('id_master_barang', 'desc')->paginate(10);
        
        // return view('pabrik.pengaturanHargaPabrik', compact('rokokPabriks','namaRokokList'));
        return response()->json([$rokokPabriks]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // 'harga_distributor' => 'required|string|max:255'
        ]);
        
        
        $setting = MasterBarang::find($id);

        
        if (!$setting) {
            return redirect()->route('pengaturanHargaDistributor')->with('error', 'Akun sales tidak ditemukan.');
        }

        
        $setting->harga_distributor = $request->harga_distributor;
        $setting->stok_slop = $request->stok_slop;
        if ($request->hasFile('gambar')) {
            $imageName = $request->username . '_produk.' . $request->gambar->extension();
            $request->gambar->storeAs('produk', $imageName, 'public');
            $setting->gambar = $imageName;
        }
        // dd($setting);
        // Menyimpan perubahan
        $setting->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pengaturanHargaDistributor')->with('success', 'Akun sales berhasil diperbarui.');
    }

    public function destroy($id_master_barang)
    {
        $daftarBarang = MasterBarang::find($id_master_barang);

        if ($daftarBarang) {
            // Hapus toko
            $daftarBarang->delete();

            return redirect()->route('pengaturanHargaPabrik')->with('success', 'User sales terkait berhasil dihapus.');
        } else {
            return redirect()->route('pengaturanHargaPabrik')->with('error', 'User tidak ditemukan.');
        }
    }
}
