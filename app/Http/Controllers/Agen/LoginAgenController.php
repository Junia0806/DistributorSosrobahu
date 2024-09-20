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
            Auth::login($user);

             // Simpan nama_lengkap ke dalam session
             session(['nama_lengkap' => $user->nama_lengkap]);
             
            return redirect()->intended('/dashboard-agen'); // ganti sesuai dengan route setelah login
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logoutAgen()
    {
        Auth::logout();
        return redirect('/login');
    }
}
