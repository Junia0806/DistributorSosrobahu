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
                        ->orWhere('status', 'like', '%' . $search . '%')
                        ->orWhere('nama_bank', 'like', '%' . $search . '%')
                        ->orWhere('no_rek', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('order_distributors_sum_total', 'desc')
            ->paginate(10); // Pagination

        // Membuat array total harga per distributor
        $totalPricePerDistributors = $akunDistributor->pluck('order_distributors_sum_total', 'id_user_distributor')->toArray();

        return view('pabrik.kelola-akun', compact('akunDistributor', 'totalPricePerDistributors'));
        //return response()->json([$akunDistributor,$totalPricePerDistributors]);
    }

    // menginputkan Akun Distributor baru
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            // 'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:user_distributor,username'
            // 'password' => 'required|string|min:6',
            // 'no_telp' => 'required|string|max:15',
            // 'gambar_ktp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Menangani upload file jika ada
        if ($request->hasFile('gambar_ktp')) {
            $file = $request->file('gambar_ktp');
            $imageName = $request->username . '_ktp.' . $file->extension();
            $file->storeAs('ktp', $imageName, 'public'); // Simpan file di storage/app/public/ktp // Simpan nama file saja di database
        }

        // Simpan data ke database
        UserDistributor::create([
            'id_user_distributor' => $request->id_user_distributor,
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => $request->password, // Enkripsi password
            'no_telp' => $request->no_telp,
            'status' => 1,
            'level' => 1,
            'gambar_ktp' => $imageName, // Simpan nama gambar
            // tolong tambahkan input formnya juga buat nama bank sama no rek di viewnya karena beda dengan akun sales
            'nama_bank' => $request->nama_bank,
            'no_rek' => $request->no_rek,
            'provinsi' => $request->provinsi,
            'alamat' => $request->alamat,
        ]);

        $totalAkunDistributor = UserDistributor::count();
        $newPage = ceil($totalAkunDistributor / 10);
        return redirect()->route('pengaturanDistributor', ['page' => $newPage])->with('success', 'Akun berhasil ditambahkan.');
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
        $distributor->provinsi = $request->provinsi;
        $distributor->alamat = $request->alamat;

        // Mengupload dan mengupdate gambar KTP jika ada
        if ($request->hasFile('gambar_ktp')) {
            $imageName =  $request->username . '.' . $request->gambar_ktp->extension();
            $request->gambar_ktp->storeAs('ktp', $imageName, 'public');
            $distributor->gambar_ktp = $imageName;
        }

        // ini juga Minta tolong tambahin edit formnya buat nama bank sama no rek
         $distributor->nama_bank = $request->nama_bank;
         $distributor->no_rek = $request->no_rek;

        // Menyimpan perubahan
        $distributor->save();

        // Ambil parameter page dari request (jika ada)
        $currentPage = $request->input('page', 1); // Default ke halaman 1 jika tidak ada parameter page
        // Redirect dengan pesan sukses
        return redirect()->route('pengaturanDistributor', ['page' => $currentPage])->with('success', 'Akun agen berhasil diperbarui.');
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
