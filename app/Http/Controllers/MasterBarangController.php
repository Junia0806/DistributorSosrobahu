<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;

class MasterBarangController extends Controller
{
    public function index()
    {
        $masterBarangs = MasterBarang::all();
        $namaRokokList = [];
    $gambarRokokList = [];
    
        //return view('master_barang.index', compact('masterBarangs'));
        
    return view('pabrik.restock', compact('masterBarangs', 'namaRokokList', 'gambarRokokList'));
    }

    public function create()
    {
        return view('master_barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rokok' => 'required|string|max:100',
            'harga_karton_pabrik' => 'required|integer',
            'stok_karton' => 'required|integer',
            'gambar' => 'required|string',
            'stok_slop' => 'required|integer',
        ]);

        MasterBarang::create($request->all());

        return redirect()->route('master_barang.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $masterBarang = MasterBarang::findOrFail($id);
        return view('master_barang.show', compact('masterBarang'));
    }

    public function edit($id)
    {
        $masterBarang = MasterBarang::findOrFail($id);
        return view('master_barang.edit', compact('masterBarang'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_rokok' => 'required|string|max:100',
            'harga_karton_pabrik' => 'required|integer',
            'stok_karton' => 'required|integer',
            'gambar' => 'required|string',
            'stok_slop' => 'required|integer',
        ]);

        $masterBarang = MasterBarang::findOrFail($id);
        $masterBarang->update($request->all());

        return redirect()->route('master_barang.index')->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        MasterBarang::findOrFail($id)->delete();
        return redirect()->route('master_barang.index')->with('success', 'Barang berhasil dihapus.');
    }
}
