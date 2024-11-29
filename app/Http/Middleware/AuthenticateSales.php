<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticateSales
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah pengguna sudah login
        if (!Auth::guard('sales')->check()) {
            
            return redirect()->route('halamanLoginSales')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        // Cek apakah session 'role' bukan 'agen'
        if (session('role') !== 'sales') {
            // Hancurkan session dan redirect ke halaman login
            session()->invalidate(); // Menghapus semua data session
            session()->regenerateToken(); // Regenerasi CSRF token
            return redirect()->route('halamanLoginSales')->with('error', 'Akses ditolak. Silakan login sebagai Sales.');
        }
        return $next($request);
        
    }
}
