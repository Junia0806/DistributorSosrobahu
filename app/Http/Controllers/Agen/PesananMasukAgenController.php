<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use App\Models\OrderSale;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PesananMasukAgenController extends Controller
{
    public function index()
    {
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $pesananMasuks = OrderSale::orderBy('id_order', 'desc')->paginate(10);

        // Mengonversi tanggal ke format Carbon
        foreach ($pesananMasuks as $pesananMasuk) {
            $pesananMasuk->tanggal = Carbon::parse($pesananMasuk->tanggal);
        }

        // Mengirim data pesanan ke view
        return view('agen.transaksiAgen', compact('pesananMasuks'));
    }
}
