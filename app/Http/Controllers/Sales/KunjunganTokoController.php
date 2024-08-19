<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\KunjunganToko;
use Illuminate\Http\Request;
use App\Models\DaftarToko;
use Carbon\Carbon;

class KunjunganTokoController extends Controller
{
    //function untuk menampilkan semua data kunjungan toko
    public function index($id_toko)
    {
        $toko = DaftarToko::find($id_toko); // Ambil informasi toko jika diperlukan
        $kunjunganToko = KunjunganToko::where('id_daftar_toko', $id_toko)->get();

        if (!$toko) {
            return redirect()->back()->with('error', 'Toko tidak ditemukan');
        }
        foreach ($kunjunganToko as $visit) {
            $visit->tanggal = Carbon::parse($visit->tanggal);
        }
        //  dd($toko->nama_toko);
        return view('sales.kunjunganToko', [
            'storeName' => $toko->nama_toko, // Nama toko untuk ditampilkan di view
            'kunjunganToko' => $kunjunganToko,
            'id_toko' => $id_toko,
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
        $request->validate([
            'id_daftar_toko' => 'required|integer',
            'tanggal' => 'required|date',
            'sisa_produk' => 'required|integer',
            'gambar' => 'required|string',
        ]);

        $kunjunganToko = KunjunganToko::create($request->all());

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
            'sisa_produk' => 'required|integer',
            'gambar' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
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
                $gambarPath = $request->file('gambar')->store('images', 'public');
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
            $kunjunganToko->delete();
            return redirect()->route('kunjunganToko', ['id_daftar_toko' => $kunjunganToko->id_daftar_toko])->with('success', 'Kunjungan toko berhasil dihapus.');
        } else {
            return redirect()->route('kunjunganToko', ['id_daftar_toko' => $kunjunganToko->id_daftar_toko])->with('error', 'Kunjungan toko tidak ditemukan.');
        }
    }
    

}