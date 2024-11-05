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

        $namaRokokList = [];
        $gambarRokokList = [];
        $stokKartonList = [];
        $stokSlopList = [];

        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $rokokPabriks = MasterBarang::orderBy('id_master_barang', 'desc')->paginate(10);
        foreach ($rokokPabriks as $barangPabrik) {
            // Get the id_master_barang for the current Barang Distributor item
            $namaProduk = $barangPabrik->id_master_barang;

            // Query the master_barang table for the corresponding record
            $orderValue = DB::table('master_barang')->where('id_master_barang', $namaProduk)->first();

            // Store the nama_rokok in the array
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
                $gambarRokokList[] = $orderValue->gambar;
                $stokKartonList[] = $orderValue->stok_karton;
                $stokSlopList[] = $orderValue->stok_slop;
            } else {
                $namaRokokList[] = null; // If no matching record is found
                $gambarRokokList[] = null;
                $stokKartonList[] = null;
                $stokSlopList[] = null;
            }
        }
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $rokokPabriks = MasterBarang::orderBy('id_master_barang', 'desc')->paginate(10);

        return view('pabrik.pengaturanHarga', compact('rokokPabriks', 'namaRokokList', 'gambarRokokList', 'stokKartonList', 'stokSlopList'));
        //return response()->json([$rokokPabriks]);
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            // 'harga_distributor' => 'required|string|max:255'
        ]);


        $setting = MasterBarang::find($id);


        if (!$setting) {
            return redirect()->route('pengaturanHargaPabrik')->with('error', 'Akun sales tidak ditemukan.');
        }

        $setting->nama_rokok = $request->nama_produk;
        $setting->harga_karton_pabrik = $request->harga_karton_pabrik;
        $setting->stok_slop = $request->stok_slop;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_produk = $request->input('nama_produk');
            $nama_file_gambar = strtolower(str_replace(' ', '_', $nama_produk)) . '.' . $file->getClientOriginalExtension();
            $request->gambar->storeAs('produk', $nama_file_gambar, 'public');
            $setting->gambar = $nama_file_gambar;
        }

        // dd($setting);
        // Menyimpan perubahan
        $setting->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pengaturanHargaPabrik')->with('success', 'Akun sales berhasil diperbarui.');
    }

    public function destroy($id_master_barang)
    {
        $daftarBarang = MasterBarang::find($id_master_barang);

        if ($daftarBarang) {
            // Hapus barang
            $daftarBarang->delete();

            return redirect()->route('pengaturanHargaPabrik')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->route('pengaturanHargaPabrik')->with('error', 'Produk tidak ditemukan.');
        }
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'harga_karton_pabrik' => 'required|numeric',
            'stok_karton' => 'required|numeric',
            'stok_slop' => 'required|numeric',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_produk = $request->input('nama_produk');
            $nama_file_gambar = strtolower(str_replace(' ', '_', $nama_produk)) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('produk', $nama_file_gambar, 'public'); // Simpan file di storage/app/public/ktp  // Simpan nama file saja di database
        }



        // Simpan data ke database
        $newProduct = new MasterBarang();
        $newProduct->nama_rokok = $request->input('nama_produk');
        $newProduct->harga_karton_pabrik = $request->input('harga_karton_pabrik');
        $newProduct->stok_karton = $request->input('stok_karton');
        $newProduct->stok_slop = $request->input('stok_slop');
        $newProduct->gambar = $nama_file_gambar;
        $newProduct->save();

        // Redirect setelah produk ditambahkan
        return redirect()->route('pengaturanHargaPabrik')->with('success', 'Produk berhasil ditambahkan');
    }
}