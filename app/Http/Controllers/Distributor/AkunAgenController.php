<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserAgen;

class AkunAgenController extends Controller
{
    // Menampilkan Akun Agen
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query utama untuk mengambil data agen
        $akunAgen = UserAgen::query()
            ->withSum('orderAgens', 'total') // Mengambil total penjualan per agen
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', '%' . $search . '%')
                        ->orWhere('username', 'like', '%' . $search . '%')
                        ->orWhere('no_telp', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('order_agens_sum_total', 'desc')
            ->paginate(5); // Pagination

        // Membuat array total harga per agen
        $totalPricePerAgens = $akunAgen->pluck('order_agens_sum_total', 'id_user_agen')->toArray();

        return view('distributor.kelola-agen', compact('akunAgen', 'totalPricePerAgens'));
        // return response()->json([$akunAgen,$totalPricePerAgens]);
    }

    // menginputkan Akun agen baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            // 'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_agen,username'
            // 'password' => 'required|string|min:6',
            // 'no_telp' => 'required|string|max:15',
            // 'gambar_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Menangani upload file jika ada
        $ktpPath = null; // Default jika tidak ada file yang diupload
        if ($request->hasFile('gambar_ktp')) {
            $file = $request->file('gambar_ktp');
            $imageName = $request->username . '_ktp.' . $file->extension();
            $file->storeAs('ktp', $imageName, 'public'); // Simpan file di storage/app/public/ktp  // Simpan nama file saja di database
        }
        // Simpan data ke database
        UserAgen::create([
            'id_user_agen' => $request->id_user_agen,
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Enkripsi password
            'no_telp' => $request->no_telp,
            'status' => 1,
            'level' => 1,
            'gambar_ktp' => $imageName, // Simpan nama gambar
            // tolong tambahkan input formnya juga buat nama bank sama no rek di viewnya karena beda dengan akun agen
            'nama_bank' => $request->nama_bank,
            'no_rek' => $request->no_rek,
        ]);
    
        return redirect()->back()->with('success', 'Akun berhasil ditambahkan.');
    }
    
    // Mengupdate Akun Agen
    public function update(Request $request, $id)
    {
        // Validasi input
        // $request->validate([
        //     // 'nama_lengkap' => 'required|string|max:255',
        //     // 'username' => 'required|string|max:255|unique:user_agen,username,' . $id . ',id_user_agen',
        //     // 'password' => 'nullable|string|min:8',
        //     // 'no_telp' => 'required|string|max:15',
        // ]);

        // Mengambil data agen berdasarkan ID
        $agen = UserAgen::find($id);

        // Jika data agen tidak ditemukan
        if (!$agen) {
            return redirect()->route('pengaturanAgen')->with('error', 'Akun agen tidak ditemukan.');
        }

        // Mengupdate data agen
        $agen->nama_lengkap = $request->nama_lengkap;
        $agen->username = $request->username;
        $agen->status = $request->status;
        // Mengupdate password jika diisi
        if ($request->filled('password')) {
            $agen->password = bcrypt($request->password);
        }

        // Mengupdate no telepon
        $agen->no_telp = $request->no_telp;

        // Mengupload dan mengupdate gambar KTP jika ada
        // if ($request->hasFile('gambar_ktp')) {
        //     $imageName = time() . '.' . $request->gambar_ktp->extension();
        //     $request->gambar_ktp->storeAs('ktp', $imageName, 'public');
        //     $agen->gambar_ktp = $imageName;
        // }

        if ($request->hasFile('gambar_ktp')) {
            $imageName = $request->username . '_ktp.' . $request->gambar_ktp->extension();
            $request->gambar_ktp->storeAs('ktp', $imageName, 'public');
            $agen->gambar_ktp = $imageName;
        }


        // ini juga Minta tolong tambahin edit formnya buat nama bank sama no rek
        // $agen->nama_bank = $request->nama_bank;
        // $agen->no_rek = $request->no_rek;

        // Menyimpan perubahan
        $agen->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pengaturanAgen')->with('success', 'Akun agen berhasil diperbarui.');
    }

    // Menghapus Akun Agen
    public function destroy($id_user_agen)
    {
        $daftarUser = UserAgen::find($id_user_agen);

        if ($daftarUser) {
            // Hapus toko
            $daftarUser->delete();

            return redirect()->route('pengaturanAgen')->with('success', 'User agen terkait berhasil dihapus.');
        } else {
            return redirect()->route('pengaturanAgen')->with('error', 'User tidak ditemukan.');
        }
    }
}
