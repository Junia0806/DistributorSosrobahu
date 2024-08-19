<?php

namespace App\Http\Controllers;

use App\Models\BarangAgen;
use Illuminate\Http\Request;

class BarangAgenController extends Controller
{
    //Menampilkan semua barang pada order sales
    public function index()
    {
        $barangAgens = BarangAgen::all();
        return view('sales.pesan_barang', compact('barangAgens'));
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
