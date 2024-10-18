<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\KunjunganToko;
use Illuminate\Http\Request;
use App\Models\DaftarToko;
use Carbon\Carbon;

class KunjunganTokoController extends Controller
{
    public function index($id_toko)
    {
        // Ambil informasi toko jika diperlukan
        $toko = DaftarToko::find($id_toko);
    
        if (!$toko) {
            return redirect()->back()->with('error', 'Toko tidak ditemukan');
        }
    
        // Mengambil data kunjungan toko dengan pagination, 5 item per halaman
        $kunjunganToko = KunjunganToko::where('id_daftar_toko', $id_toko)
            ->orderBy('tanggal', 'desc') // Urutkan berdasarkan tanggal terbaru di atas
            ->paginate(5); // Pagination dengan 5 item per halaman
    
        $gambarTokoList = [];
    
        // Jika kamu ingin mengubah format tanggal untuk ditampilkan di view
        foreach ($kunjunganToko as $visit) {
            $visit->tanggal = Carbon::parse($visit->tanggal);
            $gambarTokoList[] = $visit->gambar;
        }
    
        return view('sales.kunjunganToko', [
            'storeName' => $toko->nama_toko, // Nama toko untuk ditampilkan di view
            'kunjunganToko' => $kunjunganToko, // Pastikan ini adalah hasil paginasi
            'id_toko' => $id_toko,
            'gambarTokoList' => $gambarTokoList
        ]);
    }
    
    // Function untuk menampilkan kunjungan toko berdasarkan id
    public function show($id)
    {
        $kunjunganToko = KunjunganToko::find($id);
        if (!$kunjunganToko) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        return response()->json($kunjunganToko);
    }

    /**
     * Function untuk Menginput data ke database 
     */ public function store(Request $request)
    {
        // $request->validate([
        //     'id_daftar_toko' => 'required|integer',
        //     'tanggal' => 'required|date',
        //     'sisa_produk' => 'required|integer',
        //     'gambar' => 'required|string',
        // ]);

        if ($request->hasFile('gambar')) {
            // Simpan gambar ke folder public/storage/toko
            $path = $request->file('gambar')->store('toko', 'public');
        } else {
            $imageName = null; // Jika tidak ada gambar yang diupload
        }



        KunjunganToko::create([
            'id_daftar_toko' => $request->id_daftar_toko,
            'tanggal' => $request->tanggal,
            'sisa_produk' => $request->sisa_produk,
            'gambar' => $path, // Simpan nama gambar
        ]);

        return redirect()->route('kunjunganToko', ['id_daftar_toko' => $request->id_daftar_toko])
            ->with('success', 'Toko berhasil ditambahkan.');
    }


    /**
     * Function untuk Mengupdate ke database 
     */
    public function update(Request $request, $id_kunjungan_toko)
    {
        $request->validate([
            'id_daftar_toko' => 'required|integer',
            'tanggal' => 'required|date',
            'sisa_produk' => 'required|integer'
        ]);

        // Debugging request
        // dd($request->all(), $request->file('gambar'));

        $kunjunganToko = KunjunganToko::find($id_kunjungan_toko);
        if (!$kunjunganToko) {
            return response()->json(['message' => 'Data not found'], 404);
        } else {
            $kunjunganToko->tanggal = $request->tanggal;
            $kunjunganToko->sisa_produk = $request->sisa_produk;

            if ($request->hasFile('gambar')) {
                // Mendapatkan tanggal dan memformatnya
                $tanggal = \Carbon\Carbon::parse($request->tanggal)->format('d-m-Y');
                $extension = $request->file('gambar')->getClientOriginalExtension();
                $namaGambar = "dokumentasi {$tanggal}." . $extension;

                // Menyimpan gambar dengan nama yang ditentukan
                $gambarPath = $request->file('gambar')->storeAs('images', $namaGambar, 'public');
                $kunjunganToko->gambar = $gambarPath;
            }

            $kunjunganToko->save();
        }

        return redirect()->route('kunjunganToko', ['id_daftar_toko' => $kunjunganToko->id_daftar_toko])
            ->with('success', 'Kunjungan toko berhasil diperbarui.');
    }




    /**
     * Function untuk Menghapus atau delete ke database
     */

    public function destroy($id_kunjungan_toko)
    {
        $kunjunganToko = KunjunganToko::find($id_kunjungan_toko);

        if ($kunjunganToko) {

            $id_daftar_toko = $kunjunganToko->id_daftar_toko;
            $kunjunganToko->delete();
            return redirect()->route('kunjunganToko', ['id_daftar_toko' => $id_daftar_toko])->with('success', 'Kunjungan toko berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Kunjungan toko tidak ditemukan.');
        }
    }
}
