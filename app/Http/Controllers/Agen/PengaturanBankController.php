<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserAgen;

class PengaturanBankController extends Controller
{
    
    public function index()  
    {   
        // Ambil id_user_agen dari session
    $idUser = session('id_user_agen');

    // Cek apakah id_user_agen ada di session
    if (!$idUser) {
        // Jika tidak ada, redirect ke halaman login atau halaman lain
        return redirect()->route('login')->withErrors(['error' => 'Anda harus login terlebih dahulu.']);
    }

    // Cari data agen berdasarkan id_user_agen
    $orderAgen = UserAgen::where('id_user_agen', $idUser)->first();

    if ($orderAgen) {
        $userAgen = [
            'nama_bank' => $orderAgen->nama_bank,
            'no_rek' => $orderAgen->no_rek,
            'nama_agen' => $orderAgen->nama_lengkap,
        ];

        // Kirim data ke view
        return view('agen.pengaturanBank', compact('userAgen'));
    }

    // Jika data agen tidak ditemukan, redirect dengan pesan error
    return redirect()->back()->withErrors(['error' => 'Data agen tidak ditemukan.']);
        // return response()->json($userAgen);
    }

    public function edit($id)
    {
        // Mendapatkan data user agen berdasarkan id
        $userAgen = UserAgen::find($id);

        // Jika data user agen tidak ditemukan
        if (!$userAgen) {
            return redirect()->back()->with('error', 'Data agen tidak ditemukan.');
        }

        // Mengirim data user agen ke view untuk ditampilkan
        return view('rekening.edit', compact('userAgen'));
    }

    // Fungsi untuk memperbarui rekening agen
    public function update(Request $request)
    {
        // Ambil id_user_agen dari session
        $idUser = session('id_user_agen');

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
        $userAgen = UserAgen::find($idUser);

        // Jika data user agen tidak ditemukan
        if (!$userAgen) {
            return redirect()->back()->with('error', 'Data agen tidak ditemukan.');
        }

        // Memperbarui data rekening agen
        $userAgen->nama_bank = $request->bank_name;
        $userAgen->no_rek = $request->account_number;
        $userAgen->nama_lengkap = $request->account_holder;

        // Menyimpan perubahan ke database
        $userAgen->save();

        // Redirect ke halaman pengaturan bank dengan pesan sukses
        return redirect()->route('pengaturanBank')->with('success', 'Data rekening berhasil diperbarui.');
    }

}
