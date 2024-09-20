<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserAgen;

class PengaturanBankController extends Controller
{
    
    public function index($idUser)  
    {   
        // Ganti dengan ID order yang ingin dicari
        $idUser = 4;
        $orderAgen = UserAgen::where('id_user_agen', $idUser)->first();
        
        $userAgen = [
            'nama_bank' => $orderAgen->nama_bank,
            'no_rek' => $orderAgen->no_rek,
            'nama_agen' => $orderAgen->nama_lengkap,
        ];
        

        
        return view('agen.pengaturanBank', compact('userAgen'));
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
    public function update(Request $request, $idUser)
    {
        // Validasi input dari form
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'account_holder' => 'required|string|max:255',
        ]);

        // Mengambil data user agen berdasarkan id
        $userAgen = UserAgen::find($idUser);

        // Jika data user agen tidak ditemukan
        if (!$userAgen) {
            return redirect()->back()->with('error', 'Data agen tidak ditemukan.');
        }

        // Memperbarui data rekening agen
        $userAgen->nama_bank = $request->bank_name;
        $userAgen->no_rek = $request->account_number;
        $userAgen->nama_lengkap = $request->account_holder;
        // dd($userAgen);
        // Menyimpan perubahan ke database
        $userAgen->save();

        // Redirect ke halaman rekening dengan pesan sukses
        return redirect()->route('rekeningBank.update', $idUser)->with('success', 'Data rekening berhasil diperbarui.');
    }
}
