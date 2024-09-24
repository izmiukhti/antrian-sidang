<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Cek apakah user login dan memiliki role admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Lanjutkan jika admin
        }

        // Jika bukan admin, arahkan ke halaman dashboard user atau home
        return redirect('/user/dashboard');
    }
}

