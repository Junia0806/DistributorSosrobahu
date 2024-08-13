<?php

namespace App\Http\Controllers;

use App\Models\KunjunganToko;
use Illuminate\Http\Request;
use App\Models\DaftarToko;
use Carbon\Carbon;

class KunjunganTokoController extends Controller
{
    //function untuk menampilkan semua data kunjungan toko
    public function index()
    {
        $kunjunganToko = KunjunganToko::all();
        foreach ($kunjunganToko as $visit) {
            $visit->tanggal = Carbon::parse($visit->tanggal);
        }
        return view('sales.kunjunganToko', compact('kunjunganToko'));
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

    public function showVisitsByStore($id_daftar_toko)
    {
        $toko = KunjunganToko::find($id_daftar_toko); // Ambil informasi toko jika diperlukan
        $kunjunganToko = KunjunganToko::where('id_daftar_toko', $id_daftar_toko)->get();
        
        if (!$toko) {
            return redirect()->back()->with('error', 'Toko tidak ditemukan');
        }
        
        return view('kunjunganToko', [
            'storeName' => $toko->nama_toko, // Nama toko untuk ditampilkan di view
            'kunjunganToko' => $kunjunganToko
        ]);
    }

    /**
     * Function untuk Menginput data ke database 
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_daftar_toko' => 'required|integer',
            'tanggal' => 'required|date',
            'sisa_produk' => 'required|integer',
            'gambar' => 'required|string',
        ]);

        $kunjunganToko = KunjunganToko::create($request->all());
        return response()->json($kunjunganToko, 201);
    }

     /**
     * Function untuk Mengupdate ke database 
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_daftar_toko' => 'required|integer',
            'tanggal' => 'required|date',
            'sisa_produk' => 'required|integer',
            'gambar' => 'required|string',
        ]);

        $kunjunganToko = KunjunganToko::find($id);
        if (!$kunjunganToko) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $kunjunganToko->update($request->all());
        return response()->json($kunjunganToko);
    }

    /**
     * Function untuk Menghapus atau delete ke database
     */
    public function destroy($id)
    {
        $kunjunganToko = KunjunganToko::find($id);
        if (!$kunjunganToko) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $kunjunganToko->delete();
        return response()->json(['message' => 'Data deleted successfully']);
    }
}
