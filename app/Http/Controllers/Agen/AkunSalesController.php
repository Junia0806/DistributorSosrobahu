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
    public function index(Request $request)
    {
        $search = $request->input('search');
        $id_user_agen = session(key: 'id_user_agen');
        // Query utama untuk mengambil data sales
        $akunSales = UserSales::query()
            ->where('id_user_agen', $id_user_agen)
            ->withSum('orderSales', 'total') // Mengambil total penjualan per sales
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', '%' . $search . '%')
                        ->orWhere('username', 'like', '%' . $search . '%')
                        ->orWhere('no_telp', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('order_sales_sum_total', 'desc')
            ->paginate(10); // Pagination

        // Membuat array total harga per sales
        $totalPricePerSales = $akunSales->pluck('order_sales_sum_total', 'id_user_sales')->toArray();

        return view('agen.pengaturanAkun', compact('akunSales', 'totalPricePerSales'));
        // return response()->json([$akunSales,$totalPricePerSales]);
    }


    // public function store(Request $request)
    // {
    //     // Validasi input dari form
    //     $validated = $request->validate([
    //         // 'nama_lengkap' => 'required|string|max:255',
    //         'username' => 'required|string|max:255|unique:user_sales,username'
    //         // 'password' => 'required|string|min:6',
    //         // 'no_telp' => 'required|string|max:15',
    //         // 'gambar_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    //     ]);
    //     $id_user_agen = session('id_user_agen');

    //     // Menangani upload file jika ada
    //     $ktpPath = null; // Default jika tidak ada file yang diupload
    //     if ($request->hasFile('gambar_ktp')) {
    //         $file = $request->file('gambar_ktp');
    //         $imageName = $request->username . '_ktp.' . $file->extension();
    //         $file->storeAs('ktp', $imageName, 'public');
    //     }

    //     // Simpan data akun sales baru ke database
    //     UserSales::create([
    //         'id_user_sales' => $request->id_user_sales,
    //         'id_user_agen' => $id_user_agen,
    //         'nama_lengkap' => $request->nama_lengkap,
    //         'username' => $request->username,
    //         'password' => bcrypt($request->password), // Enkripsi password
    //         'no_telp' => $request->no_telp,
    //         'status' => 1,
    //         'level' => 1,
    //         'gambar_ktp' => $imageName, // Simpan nama gambar
    //     ]);

    //     // Hitung total akun sales untuk id_user_agen
    //     $totalAkunSales = UserSales::where('id_user_agen', $id_user_agen)->count();
    //     // Tentukan jumlah akun sales per halaman (misalnya 10 akun per halaman)
    //     $perPage = 10;

    //     // Hitung halaman tempat akun sales baru berada
    //     $newPage = ceil($totalAkunSales / $perPage);

    //     // Redirect ke halaman yang berisi akun sales baru
    //     return redirect()->route('pengaturanSales', ['page' => $newPage])->with('success', 'Akun berhasil ditambahkan.');
    // }

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
        if ($request->hasFile('gambar_ktp')) {
            $file = $request->file('gambar_ktp');
            $ktpPath = $file->store('ktp', 'public'); // Simpan file di storage/app/public/ktp
        }
        $id_user_agen = session('id_user_agen');

        // Simpan data ke database
        UserSales::create([
            'id_user_sales' => $request->id_user_sales,
            'id_user_agen' => intval($id_user_agen),
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => $request->password,
            'no_telp' => $request->no_telp,
            'status' => 1,
            'level' => 1,
            'gambar_ktp' => $ktpPath // Simpan nama gambar
        ]);


        return redirect()->back()->with('success', 'Akun berhasil ditambahkan.');
    }

    // Untuk Mengupdate data Sales
    public function update(Request $request, $id)
    {
        // Mengambil data sales berdasarkan ID
        $sales = UserSales::find($id);

        // Jika data sales tidak ditemukan
        if (!$sales) {
            return redirect()->route('pengaturanSales')->with('error', 'Akun sales tidak ditemukan.');
        }

        // Mengupdate data sales
        $sales->nama_lengkap = $request->nama_lengkap;
        $sales->username = $request->username;
        $sales->status = $request->status;

        // Mengupdate password jika diisi
        if ($request->filled('password')) {
            $sales->password = bcrypt($request->password);
        }

        // Mengupdate no telepon
        $sales->no_telp = $request->no_telp;

        // Mengupload dan mengupdate gambar KTP jika ada
        if ($request->hasFile('gambar_ktp')) {
            $imageName = $request->username . '_ktp.' . $request->gambar_ktp->extension();
            $request->gambar_ktp->storeAs('ktp', $imageName, 'public');
            $sales->gambar_ktp = $imageName;
        }

        // Menyimpan perubahan
        $sales->save();

        // Ambil parameter page dari request (jika ada)
        $currentPage = $request->input('page', 1); // Default ke halaman 1 jika tidak ada parameter page

        // Redirect dengan pesan sukses ke halaman yang sesuai
        return redirect()->route('pengaturanSales', ['page' => $currentPage])->with('success', 'Akun sales berhasil diperbarui.');
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
