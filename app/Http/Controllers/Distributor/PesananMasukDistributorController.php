<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\OrderAgen;
use App\Models\OrderDetailAgen;
use App\Models\MasterBarang;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PesananMasukDistributorController extends Controller
{
    public function index()
    {
        // Mengambil semua pesanan dan mengonversi tanggal ke format Carbon
        $pesananMasuks = OrderAgen::orderBy('id_order', 'desc')->paginate(10);

        // Mengelompokkan pesanan berdasarkan bulan dan melakukan penotalan omset per bulan
        foreach ($pesananMasuks as $pesananMasuk) {
            $pesananMasuk->tanggal = Carbon::parse($pesananMasuk->tanggal);
            // Mengambil nama user sales berdasarkan id_user_agen
            $namaAgen = DB::table('user_agen')->where('id_user_agen', $pesananMasuk->id_user_agen)->first();
            $pesananMasuk->nama_agen = $namaAgen ? $namaAgen->nama_lengkap : 'Tidak Ditemukan';
        }

        // Mengirim data yang dikelompokkan dan total omset ke view

        return view('distributor.transaksi', compact('pesananMasuks'));
    }


    public function detailPesanMasuk($idPesanan)
    {
        Carbon::setLocale('id');
        // Ganti dengan ID order yang ingin dicari
        $orderDetailAgen = OrderDetailAgen::where('id_order', $idPesanan)->first();
        $orderDetailAgenItem = OrderDetailAgen::where('id_order', $idPesanan)->get();
        $orderAgen = OrderAgen::where('id_order', $idPesanan)->first();
        $namaAgen = DB::table('user_agen')->where('id_user_agen', $orderAgen->id_user_agen)->first();



        $itemNota = [];
        $nama_rokok = [];

        foreach ($orderDetailAgenItem as $barangAgen) {
            $product = DB::table('master_barang')->where('id_master_barang', $barangAgen->id_master_barang)->first();
            $hargaSatuan = DB::table('tbl_barang_disitributor')->where('id_master_barang', $barangAgen->id_master_barang)->first();
            if ($product) { // Cek apakah product ada dan memiliki properti nama_rokok
                $nama_rokok[] = $product->nama_rokok;
                $harga_satuan[] = $hargaSatuan->harga_distributor;
                $jumlah_item[] = $barangAgen->jumlah_produk;
                $jumlah_harga[] = $barangAgen->jumlah_harga_item;
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


        $pesanMasukDistributor = [
            'tanggal' => Carbon::parse($orderAgen->tanggal)->translatedFormat('d F Y'),
            'id_order' => $orderAgen->id_order,
            'nama_agen' => $namaAgen->nama_lengkap,
            'no_telp' => $namaAgen->no_telp,
            'total_item' => $orderAgen->jumlah,
            'total_harga' => $orderAgen->total,
            'item_nota' => $itemNota,
            'gambar' => $orderAgen->bukti_transfer,
            'status' => $orderAgen->status_pemesanan,
        ];


        // dd($pesanMasukDistributor);
        return view('distributor.detail-transaksi', compact('pesanMasukDistributor'));
        // return response()->json(data: $pesanMasukDistributor);
    }

    public function editStatus($id)
    {
        // Mengambil data pesanan berdasarkan ID
        $pesanMasukDistributor = OrderAgen::findOrFail($id);

        // Mengirim data pesanan ke view
        return view('distributor.editStatusPesanan', compact('pesanMasukDistributor'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'status' => 'required|integer|in:0,1,2',
        ]);

        // Mengambil data pesanan berdasarkan ID
        $pesanMasukDistributor = OrderAgen::findOrFail($id);

        // Mengupdate status pesanan
        $pesanMasukDistributor->status_pemesanan = $request->input('status');
        $pesanMasukDistributor->save();

        // Redirect atau kembali dengan pesan sukses
        return redirect()->route('pesananMasukDistributor')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
