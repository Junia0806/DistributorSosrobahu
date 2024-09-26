<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\UserDistributor;

class PengaturanBankDistributorController extends Controller
{
    public function index($idUser)  
    {   
        // Ganti dengan ID order yang ingin dicari
        $idUser = 8;
        $rekeningDistributor = UserDistributor::where('id_user_distributor', $idUser)->first();
        
        $userDistributor = [
            'nama_bank' => $rekeningDistributor->nama_bank,
            'no_rek' => $rekeningDistributor->no_rek,
            'nama_distributor' => $rekeningDistributor->nama_lengkap,
        ];
        

        
        // return view('agen.pengaturanBank', compact('userDistributor'));
        return response()->json($userDistributor);
    }

    public function edit($id)
    {
        // Mendapatkan data user agen berdasarkan id
        $userDistributor = UserDistributor::find($id);

        // Jika data user agen tidak ditemukan
        if (!$userDistributor) {
            return redirect()->back()->with('error', 'Data agen tidak ditemukan.');
        }

        // Mengirim data user agen ke view untuk ditampilkan
        return view('rekening.edit', compact('userDistributor'));
    }

    public function update(Request $request, $idUser)
    {
        // Validasi input dari form
        $request->validate([
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|numeric',
            'account_holder' => 'required|string|max:255',
        ]);

        // Mengambil data user agen berdasarkan id
        $userDistributor = UserDistributor::find($idUser);

        // Jika data user agen tidak ditemukan
        if (!$userDistributor) {
            return redirect()->back()->with('error', 'Data agen tidak ditemukan.');
        }

        // Memperbarui data rekening agen
        $userDistributor->nama_bank = $request->bank_name;
        $userDistributor->no_rek = $request->account_number;
        $userDistributor->nama_lengkap = $request->account_holder;
        // dd($userDistributor);
        // Menyimpan perubahan ke database
        $userDistributor->save();

        // Redirect ke halaman rekening dengan pesan sukses
        return redirect()->route('rekeningBank.update', $idUser)->with('success', 'Data rekening berhasil diperbarui.');
    }
}
