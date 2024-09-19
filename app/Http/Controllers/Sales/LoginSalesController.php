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

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

             // Simpan nama_lengkap ke dalam session
             session(['nama_lengkap' => $user->nama_lengkap]);
             
            return redirect()->intended('/dashboard'); // ganti sesuai dengan route setelah login
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logoutSales()
    {
        Auth::logout();
        return redirect('/login');
    }
}
