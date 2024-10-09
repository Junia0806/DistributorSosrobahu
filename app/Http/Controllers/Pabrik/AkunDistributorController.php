<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserDistributor;

class AkunDistributorController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query utama untuk mengambil data distrbutor
        $akunDistributor = UserDistributor::query()
            ->withSum('orderDistributors', 'total') // Mengambil total penjualan per sales
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('nama_lengkap', 'like', '%' . $search . '%')
                        ->orWhere('username', 'like', '%' . $search . '%')
                        ->orWhere('no_telp', 'like', '%' . $search . '%')
                        ->orWhere('status', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('order_distributors_sum_total', 'desc')
            ->paginate(10); // Pagination

        // Membuat array total harga per distributor
        $totalPricePerDistributors = $akunDistributor->pluck('order_distributors_sum_total', 'id_user_distributor')->toArray();

        // return view('agen.pengaturanAkun', compact('akunDistributor', 'totalPricePerDistributors'));
        return response()->json([$akunDistributor,$totalPricePerDistributors]);
    }

    // menginputkan Akun Distributor baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            // 'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_sales,username'
            // 'password' => 'required|string|min:6',
            // 'no_telp' => 'required|string|max:15',
            // 'gambar_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Menangani upload file jika ada
        $ktpPath = null; // Default jika tidak ada file yang diupload
        if ($request->hasFile('gambar_ktp')) {
            $file = $request->file('gambar_ktp');
            $imageName = time() . '.' . $file->extension(); // Membuat nama file dengan timestamp
            $file->storeAs('ktp', $imageName, 'public'); // Simpan file di storage/app/public/ktp // Simpan nama file saja di database
        }

        // Simpan data ke database
        UserDistributor::create([
            'id_user_distributor' => $request->id_user_distributor,
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => bcrypt($request->password), // Enkripsi password
            'no_telp' => $request->no_telp,
            'status' => 1,
            'level' => 1,
            'gambar_ktp' => $imageName, // Simpan nama gambar
            // tolong tambahkan input formnya juga buat nama bank sama no rek di viewnya karena beda dengan akun sales
            'nama_bank' => $request->nama_bank,
            'no_rek' => $request->no_rek,
        ]);
    
        return redirect()->back()->with('success', 'Akun berhasil ditambahkan.');
    }

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
        $distributor = UserDistributor::find($id);

        // Jika data distributor tidak ditemukan
        if (!$distributor) {
            return redirect()->route('pengaturanDistributor')->with('error', 'Akun agen tidak ditemukan.');
        }

        // Mengupdate data distributor
        $distributor->nama_lengkap = $request->nama_lengkap;
        $distributor->username = $request->username;
        $distributor->status = $request->status;
        // Mengupdate password jika diisi
        if ($request->filled('password')) {
            $distributor->password = bcrypt($request->password);
        }

        // Mengupdate no telepon
        $distributor->no_telp = $request->no_telp;

        // Mengupload dan mengupdate gambar KTP jika ada
        if ($request->hasFile('gambar_ktp')) {
            $imageName = time() . '.' . $request->gambar_ktp->extension();
            $request->gambar_ktp->storeAs('ktp', $imageName, 'public');
            $distributor->gambar_ktp = $imageName;
        }

        // ini juga Minta tolong tambahin edit formnya buat nama bank sama no rek
        $distributor->nama_bank = $request->nama_bank;
        $distributor->no_rek = $request->no_rek;

        // Menyimpan perubahan
        $distributor->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pengaturanDistributor')->with('success', 'Akun agen berhasil diperbarui.');
    }

    // Menghapus Akun Distributor
    public function destroy($id_user_distributor)
    {
        $daftarUser = UserDistributor::find($id_user_distributor);

        if ($daftarUser) {
            // Hapus distributor
            $daftarUser->delete();

            return redirect()->route('pengaturanDistributor')->with('success', 'User Distributor terkait berhasil dihapus.');
        } else {
            return redirect()->route('pengaturanDistributor')->with('error', 'User tidak ditemukan.');
        }
    }
}
