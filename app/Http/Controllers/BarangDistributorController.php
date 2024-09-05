<?php

namespace App\Http\Controllers;

use App\Models\BarangDistributor;
use Illuminate\Http\Request;
use App\Models\MasterBarang;
use Illuminate\Support\Facades\DB;

class BarangDistributorController extends Controller
{
    public function index()
    {
        $barangDistributors = BarangDistributor::all();
        $namaRokokList = [];
        $gambarRokokList = [];

        // Loop through each BarangDistributor item
        foreach ($barangDistributors as $barangDistributor) {
            // Get the id_master_barang for the current BarangDistributor item
            $namaProduk = $barangDistributor->id_master_barang;

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

        

        // Pass both barangDistributors and namaRokokList to the view
        return view('agen.pesanBarang', compact('barangDistributors', 'namaRokokList','gambarRokokList'));
    }
}
