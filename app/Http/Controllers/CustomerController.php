<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customers;
use App\Models\Antrian;
use App\Models\JenisSidang;
use App\Models\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Data Pemohon',
            'list' => ['Home', 'Tambah'],
        ];
        $page = (object)[
            'title' => 'Tambah data',
        ];
        $users = User::all(); // Mengambil semua data pengguna
        $jenis_sidang = JenisSidang::all(); // Mengambil semua data jenis sidang
        $activeMenu = 'customers';
        return view('customers.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'users' => $users, 
            'jenisSidang' => $jenis_sidang, 
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'notlp' => 'required|string|max:15',
            'jenis_sidang_id' => 'required|exists:jenis_sidangs,jenis_sidang_id',
            'ktp_file' => 'required|mimes:jpg,png,pdf|max:2048',
            'kk_file' => 'required|mimes:jpg,png,pdf|max:2048',
        ]);

        // Upload file KTP
        $ktpFile = $request->file('ktp_file')->store('uploads/ktp', 'public');
        $kkFile = $request->file('kk_file')->store('uploads/kk', 'public');


        // Simpan data ke database
        $customer = Customers::create([
            'nama' => $validatedData['nama'],
            'email' => $validatedData['email'],
            'notlp' => $validatedData['notlp'],
            'jenis_sidang_id' => $validatedData['jenis_sidang_id'],
            'ktp' => $ktpFile,
            'kk' => $kkFile,
        ]);

         // Simpan data ke tabel antrians
         Antrian::create([
            'nomor_antrian' => uniqid('ANTRIAN_'), // Nomor antrian unik
            'status_sidang' => 'Pending',
            'jadwal_sidang' => now(), // Contoh jadwal sidang, bisa disesuaikan
            'user_id' => auth()->id(), // Asumsikan pengguna sudah terautentikasi
            'jenis_sidang_id' => $validatedData['jenis_sidang_id'],
        ]);

        // Redirect ke halaman lain atau kembali dengan pesan sukses
        return redirect()->back()->with('success', 'Pendaftaran berhasil!');
    }

    public function dashboard()
    {
        $customers = Customers::all();
        return view('antrian.index', compact('customers'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
