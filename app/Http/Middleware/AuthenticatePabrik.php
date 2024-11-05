<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthenticatePabrik
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
        if (!Auth::guard('pabrik')->check()) {
            
            return redirect()->route('halamanLoginPabrik')->with('error', 'Silakan login terlebih dahulu.');
        }
        
        return $next($request);
        
    }
}
