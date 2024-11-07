<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use App\Models\OrderSale;
use App\Models\OrderDetailSales;
use App\Models\BarangDistributor;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;


class PesananMasukAgenController extends Controller
{
    public function index()
    {
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $id_user_agen = session('id_user_agen');
        $pesananMasuks = OrderSale::where('id_user_agen', $id_user_agen)
            ->orderBy('id_order', 'desc')->paginate(10);


        // Mengonversi tanggal ke format Carbon
        foreach ($pesananMasuks as $pesananMasuk) {
            $pesananMasuk->tanggal = Carbon::parse($pesananMasuk->tanggal);
            // Mengambil nama user sales berdasarkan id_user_sales
            $namaSales = DB::table('user_sales')->where('id_user_sales', $pesananMasuk->id_user_sales)->first();
            $pesananMasuk->nama_sales = $namaSales ? $namaSales->nama_lengkap : 'Tidak Ditemukan';
        }
        return view('agen.transaksiAgen', compact('pesananMasuks'));
    }

    public function detailPesanMasuk($idPesanan)
    {
        Carbon::setLocale('id');
        // Ganti dengan ID order yang ingin dicari
        $orderDetailSales = OrderDetailSales::where('id_order', $idPesanan)->first();
        $orderDetailSalesItem = OrderDetailSales::where('id_order', $idPesanan)->get();
        $orderSales = OrderSale::where('id_order', $idPesanan)->first();
        $namaSales = DB::table('user_sales')->where('id_user_sales', $orderSales->id_user_sales)->first();

        $itemNota = [];
        $nama_rokok = [];

        foreach ($orderDetailSalesItem as $barangSales) {
            $product = DB::table('master_barang')->where('id_master_barang', $barangSales->id_master_barang)->first();
            $hargaSatuan = DB::table('tbl_barang_agen')->where('id_master_barang', $barangSales->id_master_barang)->first();
            if ($product) { // Cek apakah product ada dan memiliki properti nama_rokok
                $nama_rokok[] = $product->nama_rokok;
                $harga_satuan[] = $barangSales->harga_tetap_nota;
                $jumlah_item[] = $barangSales->jumlah_produk;
                $jumlah_harga[] = $barangSales->jumlah_harga_item;
            } else {
                $nama_rokok[] = null; // Jika tidak ditemukan
                $jumlah_item[] = null; // Jika tidak ditemukan
                $jumlah_harga[] = null; // Jika tidak ditemukan
                $harga_satuan[] = null; // Jika tidak ditemukan
            }

            $itemNota[] = [
                'nama_rokok' => end($nama_rokok),
                'harga_satuan' => end($harga_satuan),
                'jumlah_item' => end($jumlah_item),
                'jumlah_harga' => end($jumlah_harga),
            ];
        }


        $pesanMasukAgen = [
            'tanggal' => Carbon::parse($orderSales->tanggal)->translatedFormat('d F Y'),
            'id_order' => $orderSales->id_order,
            'nama_sales' => $namaSales->nama_lengkap,
            'no_telp' => $namaSales->no_telp,
            'total_item' => $orderSales->jumlah,
            'total_harga' => $orderSales->total,
            'item_nota' => $itemNota,
            'gambar' => $orderSales->bukti_transfer,
            'status' => $orderSales->status_pemesanan,
        ];


        // dd($pesanMasukAgen);
        return view('agen.detailPesanMasuk', compact('pesanMasukAgen'));
    }

    public function editStatus($id)
    {
        // Mengambil data pesanan berdasarkan ID
        $pesanMasukAgen = OrderSale::findOrFail($id);

        // Mengirim data pesanan ke view
        return view('agen.editStatusPesanan', compact('pesanMasukAgen'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validasi input dari form
        $request->validate([
            'status' => 'required|integer|in:0,1,2',
        ]);

        // Mengambil data pesanan berdasarkan ID
        $pesanMasukAgen = OrderSale::findOrFail($id);

        // Mengupdate status pesanan
        $pesanMasukAgen->status_pemesanan = $request->input('status');
        $pesanMasukAgen->save();

        // Redirect atau kembali dengan pesan sukses
        return redirect()->route('pesananMasuk')->with('success', 'Status pesanan berhasil diperbarui!');
    }
}
