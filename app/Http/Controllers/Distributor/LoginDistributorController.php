<?php

namespace App\Http\Controllers\Distributor;

use App\Http\Controllers\Controller;
use App\Models\UserDistributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginDistributorController extends Controller
{
    public function showLoginForm()
    {
        return view('distributor.loginDistributor');
    }

    public function loginDistributor(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = UserDistributor::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            // Cek status akun
            if ($user->status == 1) {
                // Login user
                Auth::guard('distributor')->login($user);

                // Simpan nama_lengkap ke dalam session
                session(['nama_lengkap' => $user->nama_lengkap]);
                session(['id_user_distributor' => $user->id_user_distributor]);
                session(['role'=>  'distributor']);

                // Redirect ke dashboard atau halaman lain
                return redirect()->intended('/distributor/dashboard')->with('success', 'Selamat datang, ' . $user->nama_lengkap);
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
        // Ambil ID distributor yang login dari session
        $id_user_distributor = session('id_user_distributor');
    
        if (!$id_user_distributor) {
            return response()->json([
                'message' => 'ID distributor tidak ditemukan dalam session.',
                'peringkat' => null,
            ], 404);
        }
    
        // Ambil semua distributor dengan total penjualan
        $akunDistributor = UserDistributor::withSum('orderDistributors', 'total')
            ->orderBy('order_distributors_sum_total', 'desc')
            ->get();
    
        // Buat array total penjualan dengan ID distributor sebagai kunci
        $totalPricePerDistributor = $akunDistributor->pluck('order_distributors_sum_total', 'id_user_distributor')->toArray();
    
        // Periksa apakah ID distributor login ada dalam array
        if (!array_key_exists($id_user_distributor, $totalPricePerDistributor)) {
            return response()->json([
                'message' => 'Distributor login tidak ditemukan dalam daftar ranking.',
                'peringkat' => null,
            ], 404);
        }
    
        // Hitung peringkat distributor login
        $peringkat = array_search($id_user_distributor, array_keys($totalPricePerDistributor)) + 1;
    
        // Simpan peringkat ke dalam session
        session(['peringkat' => $peringkat]);
    
        // Return data dalam format JSON
        return response()->json([
            'peringkat' => $peringkat,
            'totalPenjualan' => $totalPricePerDistributor[$id_user_distributor],
        ]);
    }
    

    public function logoutDistributor()
    {
        Auth::guard('distributor')->logout(); // Logout menggunakan guard 'sales'

        // Kosongkan session pengguna
        session()->flush();
        // Redirect ke halaman login
        return redirect()->route('halamanLoginDistributor')->with('success', 'Anda telah berhasil logout.');
    }
}
