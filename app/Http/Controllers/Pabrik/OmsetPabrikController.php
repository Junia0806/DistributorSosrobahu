<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderDistributor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OmsetPabrikController extends Controller
{
    public function omset(Request $request)
    {
        // Mengambil input tanggal dari request
        $startDate = $request->input('start');
        $endDate = $request->input('end');

        $pesananMasuks = OrderDistributor::where('order_distributor.status_pemesanan', 1)
            ->orderBy('id_order', 'desc');

        //Filter tanggal
        if ($startDate && $endDate) {
            $pesananMasuks = $pesananMasuks->whereBetween('tanggal', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay()
            ]);
        }
        if ($startDate && $endDate) {
            $pesananMasuks = $pesananMasuks->get();
        } else {
            $perPage = 10;
            $pesananMasuks = $pesananMasuks->paginate($perPage);
        }
        $omsetPerBulan = $pesananMasuks->groupBy(function ($item) {
            return Carbon::parse($item->tanggal)->format('Y-m');
        })->map(function ($group) {
            return [
                'pesanan' => $group,
                'total_omset' => $group->sum('total'),
                'total_karton' => $group->sum('jumlah'),
            ];
        });

        // Mengonversi tanggal ke format Carbon dan menambahkan nama distributor
        foreach ($pesananMasuks as $pesananMasuk) {
            $pesananMasuk->tanggal = Carbon::parse($pesananMasuk->tanggal);
            $namaDistributor = DB::table('user_distributor')->where('id_user_distributor', $pesananMasuk->id_user_distributor)->first();
            $pesananMasuk->nama_distributor = $namaDistributor ? $namaDistributor->nama_lengkap : 'Tidak Ditemukan';
        }

        //Data Rekap
        $DataMasuk = OrderDistributor::where('order_distributor.status_pemesanan', 1)
            ->orderBy('id_order', 'desc');
        $totalKarton = $DataMasuk->sum('jumlah');
        $totalHarga = $DataMasuk->sum('total');
        $totalTransaksi = $DataMasuk->count();

        return view('pabrik.laporan', compact('omsetPerBulan', 'totalKarton', 'totalHarga', 'totalTransaksi', 'pesananMasuks', 'startDate', 'endDate'));
    }
}
