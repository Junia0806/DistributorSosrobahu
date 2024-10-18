<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserDistributor;

class PengaturanBankDistributorController extends Controller
{
    public function index()  
    {   
        $idUser = session('id_user_distributor');

    // Cek apakah id_user_agen ada di session
    if (!$idUser) {
        // Jika tidak ada, redirect ke halaman login atau halaman lain
        return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
    }

    // Cari data agen berdasarkan id_user_agen
    $orderDistributor = UserDistributor::where('id_user_distributor', $idUser)->first();

    if ($orderDistributor) {
        $userDistributor = [
            'nama_bank' => $orderDistributor->nama_bank,
            'no_rek' => $orderDistributor->no_rek,
            'nama_distributor' => $orderDistributor->nama_lengkap,
        ];

        // Kirim data ke view
        return view('distributor.pengaturanBank', compact('userDistributor'));
    }

    // Jika data agen tidak ditemukan, redirect dengan pesan error
    return redirect()->back()->withErrors(['error' => 'Data agen tidak ditemukan.']);
        // return response()->json($userAgen);
    }

    public function edit($id)
    {
        // Mendapatkan data user agen berdasarkan id
        $userDistributor = UserDistributor::find($id);

        // Jika data user agen tidak ditemukan
        if (!$userDistributor) {
            return redirect()->back()->with('error', 'Data distributor tidak ditemukan.');
        }

        // Mengirim data user agen ke view untuk ditampilkan
        return view('rekening.edit', compact('userDistributor'));
    }

    public function update(Request $request)
    {
        // Ambil id_user_agen dari session
        $idUser = session('id_user_distributor');

        // Jika id_user_agen tidak ada di session, redirect ke login
        if (!$idUser) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi input dari form
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'account_holder' => 'required|string|max:255',
        ]);

        // Mengambil data user agen berdasarkan id_user_agen dari session
        $userDistributor = UserDistributor::find($idUser);

        // Jika data user agen tidak ditemukan
        if (!$userDistributor) {
            return redirect()->back()->with('error', 'Data distributor tidak ditemukan.');
        }

        // Memperbarui data rekening agen
        $userDistributor->nama_bank = $request->bank_name;
        $userDistributor->no_rek = $request->account_number;
        $userDistributor->nama_lengkap = $request->account_holder;

        // Menyimpan perubahan ke database
        $userDistributor->save();

        // Redirect ke halaman pengaturan bank dengan pesan sukses
        return redirect()->route('pengaturanBankDistributor')->with('success', 'Data rekening berhasil diperbarui.');
    }
}
