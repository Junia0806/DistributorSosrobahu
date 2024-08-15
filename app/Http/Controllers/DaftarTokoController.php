<?php

namespace App\Http\Controllers;

use App\Models\DaftarToko;
use Illuminate\Http\Request;

class DaftarTokoController extends Controller
{
    /**
     * Function untuk menampilkan semua daftar toko
     */
    public function index()
    {
        $toko = DaftarToko::all();
        return view('sales.tokoSales', compact('toko'));
    }

    /**
     * Function untuk menampilkan kunjungan toko berdasarkan id daftar toko
     */
    public function getByDaftarToko($id_daftar_toko)
    {
        $kunjunganToko = KunjunganToko::where('id_daftar_toko', $id_daftar_toko)->get();
        return response()->json($kunjunganToko);
    }

    /**
     * Function untuk menampilkan toko berdasarkan id
     */
    public function show($id)
    {
        $daftarToko = DaftarToko::find($id);
        if (!$daftarToko) {
            return redirect()->route('daftar_toko.index')->with('error', 'Toko tidak ditemukan.');
        }
        return view('daftar_toko.show', compact('daftarToko'));
    }

    // Function untuk memanggil halaman/view input
    public function create()
    {
        return view('daftar_toko.create');
    }

    /**
     * Function untuk input ke database
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'no_telp' => 'required|string|max:100',
        ]);

        DaftarToko::create($request->all());

        return redirect()->route('daftar_toko.index')->with('success', 'Toko berhasil ditambahkan.');
    }

    // Function untuk memanggil halaman/view toko
    public function showtoko(DaftarToko $daftarToko)
    {
        return view('daftar_toko.show', compact('daftarToko'));
    }

    
    // Function untuk memanggil halaman/view edit
    public function edit(DaftarToko $daftarToko)
    {
        return view('daftar_toko.edit', compact('daftarToko'));
    }

    /**
     * Function untuk Mengupdate ke database 
     */

    public function update(Request $request, DaftarToko $daftarToko)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'no_telp' => 'required|string|max:100',
        ]);

        $daftarToko->update($request->all());

        return redirect()->route('daftar_toko.index')->with('success', 'Toko berhasil diupdate.');
    }

    /**
     * Function untuk Menghapus atau delete ke database
     */

    public function destroy(DaftarToko $daftarToko)
    {
        $daftarToko->delete();

        return redirect()->route('daftar_toko.index')->with('success', 'Toko berhasil dihapus.');
    }
}
