<?php

namespace App\Http\Controllers\Agen;

use App\Http\Controllers\Controller;
use App\Models\UserAgen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAgenController extends Controller
{
    public function showLoginForm()
    {
        return view('agen.loginAgen');
    }

    public function loginAgen(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = UserAgen::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            // Cek status akun
            if ($user->status == 1) {
                // Login user
                Auth::guard('agen')->login($user);

                // Simpan nama_lengkap ke dalam session
                session(['nama_lengkap' => $user->nama_lengkap]);
                session(['id_user_agen' => $user->id_user_agen]);
                session(['id_user_distributor' => $user->id_user_distributor]);
                session(['role'=>  'agen']);


                // Redirect ke dashboard atau halaman lain
                return redirect()->intended('/dashboard-agen')->with('success', 'Selamat datang, ' . $user->nama_lengkap);
            } else {
                // Jika status akun tidak aktif (status == 0)
                return back()->withErrors([
                    'username' => 'Akun Anda tidak aktif. Silakan hubungi admin.',
                ]);
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function updateRanking()
    {
        $id_user_agen = session('id_user_agen'); 
    
        $distributorId = UserAgen::where('id_user_agen', $id_user_agen)
            ->value('id_user_distributor');
    
        if (!$distributorId) {
            return response()->json([
                'message' => 'Distributor tidak ditemukan untuk user ini.',
                'peringkat' => null,
            ], 404);
        }
    
        $akunAgen = UserAgen::where('id_user_distributor', $distributorId)
            ->withSum('orderAgens', 'total')
            ->orderBy('order_agens_sum_total', 'desc')
            ->get();
    
        $totalPricePerSales = $akunAgen->pluck('order_agens_sum_total', 'id_user_agen')->toArray();
    
        if (!array_key_exists($id_user_agen, $totalPricePerSales)) {
            return response()->json([
                'message' => 'User tidak ditemukan dalam daftar ranking untuk distributor ini.',
                'peringkat' => null,
            ], 404);
        }
    
        $peringkat = array_search($id_user_agen, array_keys($totalPricePerSales)) + 1;
    
        session(['peringkat' => $peringkat]);
    
        return response()->json([
            'peringkat' => $peringkat,
            'id_user_distributor' => $distributorId,
        ]);
    }
    
    

    public function logoutAgen()
    {
        Auth::guard('agen')->logout(); // Logout menggunakan guard 'sales'

        // Kosongkan session pengguna
        session()->flush();
        // Redirect ke halaman login
        return redirect()->route('halamanLoginAgen')->with('success', 'Anda telah berhasil logout.');
    }
}
