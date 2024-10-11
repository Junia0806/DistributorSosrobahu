<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserPabrik;

class PengaturanBankPabrikController extends Controller
{
    public function index()  
    {   
        // Ambil id_user_pabrik dari session
    $idUser = session('id_user_pabrik');

    // Cek apakah id_user_pabrik ada di session
    if (!$idUser) {
        // Jika tidak ada, redirect ke halaman login atau halaman lain
        return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
    }

    // Cari data agen berdasarkan id_user_pabrik
    $akunPabrik = UserPabrik::where('id_user_pabrik', $idUser)->first();

    if ($akunPabrik) {
        $userPabrik = [
            'nama_bank' => $akunPabrik->nama_bank,
            'no_rek' => $akunPabrik->no_rek,
            'nama_pabrik' => $akunPabrik->nama_lengkap,
        ];

        // Kirim data ke view
        return view('pabrik.pengaturanBank', compact('userPabrik'));
    }

    // Jika data agen tidak ditemukan, redirect dengan pesan error
    return redirect()->back()->withErrors(['error' => 'Data agen tidak ditemukan.']);
        // return response()->json($userPabrik);
    }

    public function edit($id)
    {
        // Mendapatkan data user agen berdasarkan id
        $userPabrik = UserPabrik::find($id);

        // Jika data user agen tidak ditemukan
        if (!$userPabrik) {
            return redirect()->back()->with('error', 'Data agen tidak ditemukan.');
        }

        // Mengirim data user agen ke view untuk ditampilkan
        return view('rekening.edit', compact('userPabrik'));
    }

    // Fungsi untuk memperbarui rekening agen
    public function update(Request $request)
    {
        // Ambil id_user_pabrik dari session
        $idUser = session('id_user_pabrik');

        // Jika id_user_pabrik tidak ada di session, redirect ke login
        if (!$idUser) {
            return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
        }

        // Validasi input dari form
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'account_holder' => 'required|string|max:255',
        ]);

        // Mengambil data user agen berdasarkan id_user_pabrik dari session
        $userPabrik = UserPabrik::find($idUser);

        // Jika data user agen tidak ditemukan
        if (!$userPabrik) {
            return redirect()->back()->with('error', 'Data agen tidak ditemukan.');
        }

        // Memperbarui data rekening agen
        $userPabrik->nama_bank = $request->bank_name;
        $userPabrik->no_rek = $request->account_number;
        $userPabrik->nama_lengkap = $request->account_holder;

        // Menyimpan perubahan ke database
        $userPabrik->save();

        // Redirect ke halaman pengaturan bank dengan pesan sukses
        return redirect()->route('pengaturanBankPabrik')->with('success', 'Data rekening berhasil diperbarui.');
    }
}
