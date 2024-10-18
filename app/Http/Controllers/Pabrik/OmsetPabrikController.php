<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDistributor;
use Carbon\Carbon;

class OmsetPabrikController extends Controller
{
    public function omset(Request $request)  {

    // Mengambil input bulan dan tahun dari request
    $bulan = $request->input('bulan'); // format: 01 - 12
    $tahun = $request->input('tahun'); // format: 2024, 2023, etc.

    // Query dasar: mengambil semua pesanan distributor
    $pesananMasuks = OrderDistributor::orderBy('id_order', 'desc');

    // Filter berdasarkan bulan dan tahun jika ada input
    if ($bulan && $tahun) {
        $pesananMasuks = $pesananMasuks->whereMonth('tanggal', $bulan)
                                       ->whereYear('tanggal', $tahun);
    }

    // Dapatkan hasil query setelah filter
    $pesananMasuks = $pesananMasuks->get();

    // Mengelompokkan pesanan berdasarkan bulan dan melakukan penotalan omset per bulan
    $omsetPerBulan = $pesananMasuks->groupBy(function($item) {
        // Mengelompokkan berdasarkan bulan dan tahun (misalnya, "2024-10")
        return Carbon::parse($item->tanggal)->format('Y-m');
    })->map(function($group) {
        // Menambahkan total omset untuk setiap kelompok bulan
        return [
            'pesanan' => $group,
            'total_omset' => $group->sum('total'),
        ];
    });

    // Mengembalikan hasil dalam format JSON
    return response()->json([$omsetPerBulan]);
    }
}
