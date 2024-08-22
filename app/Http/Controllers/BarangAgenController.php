<?php

namespace App\Http\Controllers;

use App\Models\BarangAgen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BarangAgenController extends Controller
{
    //Menampilkan semua barang pada order sales
    public function index()
    {
        $barangAgens = BarangAgen::all();
        $namaRokokList = [];

        // Loop through each BarangAgen item
        foreach ($barangAgens as $barangAgen) {
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

        // Pass both barangAgens and namaRokokList to the view
        return view('sales.pesan_barang', compact('barangAgens', 'namaRokokList'));
    }


    public function create()
    {
        return view('barang_agen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_master_barang' => 'required|integer',
            'id_user_agen' => 'required|integer',
            'harga_agen' => 'required|integer',
            'stok_karton' => 'required|integer',
        ]);

        BarangAgen::create($request->all());

        return redirect()->route('barang_agen.index')->with('success', 'Barang Agen berhasil ditambahkan.');
    }

    public function show($id)
    {
        $barangAgen = BarangAgen::findOrFail($id);
        return view('barang_agen.show', compact('barangAgen'));
    }

    public function edit($id)
    {
        $barangAgen = BarangAgen::findOrFail($id);
        return view('barang_agen.edit', compact('barangAgen'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_master_barang' => 'required|integer',
            'id_user_agen' => 'required|integer',
            'harga_agen' => 'required|integer',
            'stok_karton' => 'required|integer',
        ]);

        $barangAgen = BarangAgen::findOrFail($id);
        $barangAgen->update($request->all());

        return redirect()->route('barang_agen.index')->with('success', 'Barang Agen berhasil diperbarui.');
    }

    

    public function destroy($id)
    {
        BarangAgen::findOrFail($id)->delete();
        return redirect()->route('barang_agen.index')->with('success', 'Barang Agen berhasil dihapus.');
    }
}
