<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use App\Models\OrderDistributor;
use App\Models\OrderDetailDistributor;
use App\Models\MasterBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PesananMasukPabrikController extends Controller
{
    public function index()
    {
        // Mengambil semua pesanan dan mengonversi tanggal ke format Carbon
        $pesananMasuks = OrderDistributor::orderBy('id_order', 'desc')->get();
        
        // Mengelompokkan pesanan berdasarkan bulan dan melakukan penotalan omset per bulan
        $pesananPerBulan = $pesananMasuks->groupBy(function($item) {
            // Mengelompokkan berdasarkan bulan dan tahun (misalnya, "2024-10")
            return Carbon::parse($item->tanggal)->format('Y-m');
        })->map(function($group) {
            // Menambahkan total omset untuk setiap kelompok bulan
            return [
                'pesanan' => $group,
                'total_omset' => $group->sum('total'),
            ];
        });

        // Mengirim data yang dikelompokkan dan total omset ke view
        return response()->json([$pesananMasuks,$pesananPerBulan]);
    }

    public function detailPesanMasuk($idPesanan)
    {
        // Ganti dengan ID order yang ingin dicari
        $orderDetailDistributor = OrderDetailDistributor::where('id_order', $idPesanan)->first();
        $orderDetailDistributorItem = OrderDetailDistributor::where('id_order', $idPesanan)->get();
        $orderDistributor = OrderDistributor::where('id_order', $idPesanan)->first();
        $namaDistributor = DB::table('user_distributor')->where('id_user_distributor', $orderDistributor->id_user_distributor)->first();



        $itemNota = [];
        $nama_rokok = [];

        foreach ($orderDetailDistributorItem as $barangDistributor) {
            $product = DB::table('master_barang')->where('id_master_barang', $barangDistributor->id_master_barang)->first();
            $hargaSatuan = DB::table('master_barang')->where('id_master_barang', $barangDistributor->id_master_barang)->first();
            if ($product) { // Cek apakah product ada dan memiliki properti nama_rokok
                $nama_rokok[] = $product->nama_rokok;
                $harga_satuan[] = $hargaSatuan->harga_karton_pabrik;
                $jumlah_item[] = $barangDistributor->jumlah_produk;
                $jumlah_harga[] = $barangDistributor->jumlah_harga_item;
            } else {
                $nama_rokok[] = null; // Jika tidak ditemukan
                $jumlah_item[] = null; // Jika tidak ditemukan
                $jumlah_harga[] = null; // Jika tidak ditemukan
                $harga_satuan[] = null; // Jika tidak ditemukan
            }

            $itemNota[] = [
                'nama_rokok' => end($nama_rokok), // Gunakan end() untuk mengambil elemen terakhir
                'harga_satuan' => end($harga_satuan),
                'jumlah_item' => end($jumlah_item),
                'jumlah_harga' => end($jumlah_harga),
            ];
        }


        $pesanMasukPabrik = [
            'tanggal' => $orderDistributor->tanggal,
            'id_order' => $orderDistributor->id_order,
            'nama_agen' => $namaDistributor->nama_lengkap,
            'no_telp' => $namaDistributor->no_telp,
            'total_item' => $orderDistributor->jumlah,
            'total_harga' => $orderDistributor->total,
            'item_nota' => $itemNota,
            'gambar' => $orderDistributor->bukti_transfer,
            'status' => $orderDistributor->status_pemesanan,
        ];


        // dd($pesanMasukPabrik);
        // return view('agen.detailPesanMasuk', compact('pesanMasukPabrik'));
        return response()->json(data: $pesanMasukPabrik);
    }

    public function editStatus($id)
    {
        // Mengambil data pesanan berdasarkan ID
        $pesanMasukPabrik= OrderDistributor::findOrFail($id);

        // Mengirim data pesanan ke view
        return view('pabrik.editStatusPesanan', compact('pesanMasukPabrik'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'status' => 'required|integer|in:0,1,2',
        ]);

        // Mengambil data pesanan berdasarkan ID
        $pesanMasukPabrik = OrderDistributor::findOrFail($id);

        // Mengupdate status pesanan
        $pesanMasukPabrik->status_pemesanan = $request->input('status');
        $pesanMasukPabrik->save();

        // Redirect atau kembali dengan pesan sukses
        return redirect()->route('pesananMasukPabrik')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
