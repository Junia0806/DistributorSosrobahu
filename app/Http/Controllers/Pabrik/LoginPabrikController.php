<?php

namespace App\Http\Controllers\Pabrik;

use App\Http\Controllers\Controller;
use App\Models\UserPabrik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginPabrikController extends Controller
{
    public function showLoginForm()
    {
        return view('pabrik.loginPabrik');
    }

    public function loginPabrik(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = UserPabrik::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {

            // Cek status akun
            if ($user->status == 1) {
                // Login user
                Auth::guard('pabrik')->login($user);

                // Simpan nama_lengkap ke dalam session
                session(['nama_lengkap' => $user->nama_lengkap]);
                session(['id_user_pabrik' => $user->id_user_pabrik]);

                // Redirect ke dashboard atau halaman lain
                return redirect()->intended('/pabrik/dashboard')->with('success', 'Selamat datang, ' . $user->nama_lengkap);
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

    public function logoutPabrik()
    {
        Auth::guard('pabrik')->logout(); // Logout menggunakan guard 'sales'

        // Kosongkan session pengguna
        session()->flush();
        // Redirect ke halaman login
        return redirect()->route('halamanLoginPabrik')->with('success', 'Anda telah berhasil logout.');
    }
}
