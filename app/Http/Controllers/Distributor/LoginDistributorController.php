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
            Auth::login($user);

             // Simpan nama_lengkap ke dalam session
             session(['nama_lengkap' => $user->nama_lengkap]);
             
            return redirect()->intended('/distributor/dashboard'); // ganti sesuai dengan route setelah login
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ]);
    }

    public function logoutDistributor()
    {
        Auth::logout();
        return redirect('/login');
    }
}
