<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\UserSales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class LoginSalesController extends Controller
{
    public function showLoginForm()
    {
        return view('sales.loginSales');
    }

    public function loginSales(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Ambil user dari model UserSales
        $user = UserSales::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Cek status akun
            if ($user->status == 1) {
                // Login user menggunakan guard sales
                Auth::guard('sales')->login($user);

                // Simpan nama_lengkap ke dalam session
                session(['nama_lengkap' => $user->nama_lengkap]);
                session(['id_user_sales' => $user->id_user_sales]);
                session(['id_user_agen' => $user->id_user_agen]);
                session(['role'=>  'sales']);


                // Redirect ke dashboard atau halaman lain
                return redirect()->intended('/dashboard')->with('success', 'Selamat datang, ' . $user->nama_lengkap);
            } else {
                // Jika status akun tidak aktif
                return back()->withErrors([
                    'username' => 'Akun Anda tidak aktif. Silakan hubungi admin.',
                ]);
            }
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }


    // public function updateRanking()
    // {
    //     // Ambil ID user yang sedang login
    //     $userId = Auth::guard('sales')->id();
    //     $id_user_sales = session('id_user_sales');
    //     $akunSales = UserSales::where('id_user_sales', $id_user_sales)
    //         ->withSum('orderSales', 'total')
    //         ->orderBy('order_sales_sum_total', 'desc')
    //         ->get(); 

    //     $totalPricePerSales = $akunSales->pluck('order_sales_sum_total', 'id_user_sales')->toArray();

    //     $peringkat = array_search($userId, array_keys($totalPricePerSales)) + 1;
    //     session(['peringkat' => $peringkat]);

    //     return response()->json(['peringkat' => $peringkat]);
    // }

    public function updateRanking()
    {
        $id_user_sales = session('id_user_sales');
        $agenId = UserSales::where('id_user_sales', $id_user_sales)
            ->value('id_user_agen');
        if (!$agenId) {
            return response()->json([
                'message' => 'Distributor tidak ditemukan untuk sales ini.',
                'peringkat' => null,
            ], 404);
        }
        $akunSales = UserSales::where('id_user_agen', $agenId)
            ->withSum('orderSales', 'total')
            ->orderBy('order_sales_sum_total', 'desc')
            ->get();
    
        $totalPricePerSales = $akunSales->pluck('order_sales_sum_total', 'id_user_sales')->toArray();
    
        if (!array_key_exists($id_user_sales, $totalPricePerSales)) {
            return response()->json([
                'message' => 'Sales tidak ditemukan dalam daftar ranking untuk distributor ini.',
                'peringkat' => null,
            ], 404);
        }
        $peringkat = array_search($id_user_sales, array_keys($totalPricePerSales)) + 1;
        session(['peringkat' => $peringkat]);
        return response()->json([
            'peringkat' => $peringkat,
            'id_user_agen' => $agenId,
        ]);
    }
    
    public function logoutSales()
    {
        Auth::guard('sales')->logout(); // Logout menggunakan guard 'sales'

        // Kosongkan session pengguna
        session()->flush();
        // Redirect ke halaman login
        return redirect()->route('halamanLoginSales')->with('success', 'Anda telah berhasil logout.');
    }
}
