<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarang;
use Illuminate\Support\Facades\DB;

class BarangPabrikController extends Controller
{
    public function index()
    {
        $barangPabriks = MasterBarang::all();
        $namaRokokList = [];
        $gambarRokokList = [];

        // Loop through each BarangPabrik item
        foreach ($barangPabriks as $barangPabrik) {
            // Get the id_master_barang for the current BarangPabrik item
            $namaProduk = $barangPabrik->id_master_barang;

            // Query the master_barang table for the corresponding record
            $orderValue = DB::table('master_barang')->where('id_master_barang', $namaProduk)->first();

            // Store the nama_rokok in the array
            if ($orderValue) {
                $namaRokokList[] = $orderValue->nama_rokok;
                $gambarRokokList[] = $orderValue->gambar;
            } else {
                $namaRokokList[] = null; // If no matching record is found
                $gambarRokokList[] = null;
            }
        }

        

        // Pass both barangPabriks and namaRokokList to the view
        // return view('agen.pesanBarang', compact('barangPabriks', 'namaRokokList','gambarRokokList'));
        
        return response()->json([$barangPabriks,$namaRokokList,$gambarRokokList]);
    }
}
