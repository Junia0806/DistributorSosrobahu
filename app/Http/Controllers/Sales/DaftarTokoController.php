<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\DaftarToko;
use App\Models\KunjunganToko;
use Illuminate\Http\Request;

class DaftarTokoController extends Controller
{
    /**
     * Function untuk menampilkan semua daftar toko
     */
    public function index()
    {
        $id_user_sales = session('id_user_sales');

        $toko = DaftarToko::where('id_user_sales', $id_user_sales)
            ->paginate(5); // Mengambil 5 data per halaman
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
        // Validasi inputan
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'no_telp' => 'required|string|max:100',
        ]);

        // Ambil id_user_sales dari session
        $id_user_sales = session('id_user_sales');

        // Tambahkan id_user_sales ke dalam inputan data
        $data = $request->all();
        $data['id_user_sales'] = $id_user_sales;

        // Simpan data ke tabel daftar_toko
        DaftarToko::create($data);

        // Redirect ke route tokoSales dengan pesan sukses
        return redirect()->route('tokoSales')->with('success', 'Toko berhasil ditambahkan.');
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

    public function update(Request $request, $id_daftar_toko)
    {
        $request->validate([
            'nama_toko' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'no_telp' => 'required|string|max:100',
        ]);


        $daftarToko = DaftarToko::find($id_daftar_toko);
        if (!$daftarToko) {
            return response()->json(['message' => 'Data not found'], 404);
        } else {
            $daftarToko->nama_toko = $request->nama_toko;
            $daftarToko->lokasi = $request->lokasi;
            $daftarToko->nama_pemilik = $request->nama_pemilik;
            $daftarToko->no_telp = $request->no_telp;
            $daftarToko->save();
        }

        $daftarToko->update($request->all());
        return redirect()->route('tokoSales')->with('success', 'Toko dan kunjungan terkait berhasil dihapus.');
    }

    /**
     * Function untuk Menghapus atau delete ke database
     */

    public function destroy($id_daftar_toko)
    {
        $daftarToko = DaftarToko::find($id_daftar_toko);

        if ($daftarToko) {
            // Hapus semua kunjungan terkait toko ini
            $daftarToko->kunjunganToko()->delete();

            // Hapus toko
            $daftarToko->delete();

            return redirect()->route('tokoSales')->with('success', 'Toko dan kunjungan terkait berhasil dihapus.');
        } else {
            return redirect()->route('tokoSales')->with('error', 'Toko tidak ditemukan.');
        }
    }
}
