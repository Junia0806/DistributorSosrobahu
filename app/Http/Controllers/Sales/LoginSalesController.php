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

        $user = UserSales::where('username', $request->username)->first();

        if (Hash::check($request->password, $user->password)) {
            Auth::login($user);

             // Simpan nama_lengkap ke dalam session
             session(['nama_lengkap' => $user->nama_lengkap]);
             
            return redirect()->intended('/dashboard'); // ganti sesuai dengan route setelah login
        }
        // dd($user, Hash::check($request->password, $user->password));

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
        
    }

    public function updateRanking()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id(); // Pastikan pengguna sudah login

        // Mengambil data sales dengan total penjualan, urut berdasarkan total penjualan tertinggi
        $akunSales = UserSales::withSum('orderSales', 'total')
            ->orderBy('order_sales_sum_total', 'desc')
            ->get(); // Ambil semua data tanpa pagination

        // Buat array untuk total penjualan
        $totalPricePerSales = $akunSales->pluck('order_sales_sum_total', 'id_user_sales')->toArray();

        // Hitung peringkat pengguna saat ini
        $peringkat = array_search($userId, array_keys($totalPricePerSales)) + 1;

        // Simpan peringkat ke dalam session
        session(['peringkat' => $peringkat]);

        return response()->json(['peringkat' => $peringkat]);
    }


    public function logoutSales()
    {
        Auth::logout();
        return redirect('/login');
    }
}
