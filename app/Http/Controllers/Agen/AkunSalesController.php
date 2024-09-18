<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserSales;
use App\Models\OrderSale;
use Illuminate\Foundation\Auth\User;

class AkunSalesController extends Controller
{   
    // Menampilkan Data Sales
    public function index()
    {
        // Mengambil pesanan dengan mengurutkan berdasarkan ID terbesar
        $akunSales = UserSales::orderBy('id_user_sales', 'desc')->paginate(10);
        $totalPricePerSales = [];

        // Mengambil total penjualan untuk setiap sales
        foreach ($akunSales as $sales) {
            // Menghitung total harga berdasarkan id_user_sales
            $totalOrderSales = OrderSale::where('id_user_sales', $sales->id_user_sales)->get();
            $totalPricePerSales[$sales->id_user_sales] = $totalOrderSales->sum('total');
        }

        return view('agen.pengaturanAkun', compact('akunSales','totalPricePerSales'));
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        // $validated = $request->validate([
        //     // 'nama_lengkap' => 'required|string|max:255',
        //     // 'username' => 'required|string|max:255|unique:sales,username',
        //     // 'password' => 'required|string|min:6',
        //     // 'no_telp' => 'required|string|max:15',
        //     // 'gambar_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        // ]);

        // Menangani upload file jika ada
        // if ($request->hasFile('gambar_ktp')) {
        //     $file = $request->file('gambar_ktp');
        //     $ktpPath = $file->store('ktp', 'public'); // Simpan file di storage/app/public/ktp
        // }

        if ($request->hasFile('gambar_ktp')) {
            $file = $request->file('gambar_ktp');
            $imageName = time() . '.' . $file->extension(); // Membuat nama file dengan timestamp
            $file->storeAs('ktp', $imageName, 'public'); // Simpan file di storage/app/public/ktp // Simpan nama file saja di database
        }
        

        // Simpan data ke database
        UserSales::create([
            'id_user_sales' => $request->id_user_sales,
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => $request->password,
            'no_telp' => $request->no_telp,
            'status' => 1,
            'level' => 1,
            'gambar_ktp' => $imageName // Simpan nama gambar
        ]);


        return redirect()->back()->with('success', 'Akun berhasil ditambahkan.');
    }

    // Untuk Mengupdate data Sales
    public function update(Request $request, $id)
    {
        // Validasi input
        // $request->validate([
        //     // 'nama_lengkap' => 'required|string|max:255',
        //     // 'username' => 'required|string|max:255|unique:user_sales,username,' . $id . ',id_user_sales',
        //     // 'password' => 'nullable|string|min:8',
        //     // 'no_telp' => 'required|string|max:15',
        // ]);
        
        // Mengambil data sales berdasarkan ID
        $sales = UserSales::find($id);

        // Jika data sales tidak ditemukan
        if (!$sales) {
            return redirect()->route('pengaturanSales')->with('error', 'Akun sales tidak ditemukan.');
        }

        // Mengupdate data sales
        $sales->nama_lengkap = $request->nama_lengkap;
        $sales->username = $request->username;
        
        // Mengupdate password jika diisi
        if ($request->filled('password')) {
            $sales->password = bcrypt($request->password);
        }

        // Mengupdate no telepon
        $sales->no_telp = $request->no_telp;

        // Mengupload dan mengupdate gambar KTP jika ada
        if ($request->hasFile('gambar_ktp')) {
            $imageName = time() . '.' . $request->gambar_ktp->extension();
            $request->gambar_ktp->storeAs('ktp', $imageName, 'public');
            $sales->gambar_ktp = $imageName;
        }

        // Menyimpan perubahan
        $sales->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pengaturanSales')->with('success', 'Akun sales berhasil diperbarui.');
    }

    public function destroy($id_user_sales)
    {
        $daftarUser = UserSales::find($id_user_sales);

        if ($daftarUser) {
            // Hapus toko
            $daftarUser->delete();

            return redirect()->route('pengaturanSales')->with('success', 'User sales terkait berhasil dihapus.');
        } else {
            return redirect()->route('pengaturanSales')->with('error', 'User tidak ditemukan.');
        }
    }


}