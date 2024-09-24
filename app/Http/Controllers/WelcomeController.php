<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Tampilkan halaman dashboard untuk admin atau user
     */
    public function index()
    {
        // Mendapatkan user yang sedang login
        $user = Auth::user();

        // Cek role user dan tampilkan dashboard yang sesuai
        if ($user->role === 'admin') {
            return view('admin.dashboard', ['user' => $user]);
        } elseif ($user->role === 'user') {
            return view('user.dashboard', ['user' => $user]);
        } else {
            // Jika role tidak diketahui, bisa redirect atau tampilkan pesan
            return redirect()->route('dashboard')->with('error', 'Role tidak dikenali.');
        }
    }
}
