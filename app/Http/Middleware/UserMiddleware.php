<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user login dan memiliki role user
        if (Auth::check() && Auth::user()->role === 'user') {
            return $next($request); // Lanjutkan jika user
        }

        // Jika bukan user, arahkan ke halaman dashboard admin atau home
        return redirect('/admin/dashboard');
    }
}
