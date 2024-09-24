<?php

namespace App\Http\Controllers;

use App\Models\JenisSidang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JenisSidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Antrian',
            'list' => ['Home', 'Cuti'],
        ];
        $page = (object)[
            'title' => 'Data antrian yang tersimpan dalam sistem',
        ];
        $jenis_sidang = JenisSidang::all();
        $activeMenu = 'jenis_sidang';
        return view('jenis_sidang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'jenis_sidang' => $jenis_sidang, 'activeMenu' => $activeMenu]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $breadcrumb = (object)[
            'title' => 'Tambah Data Cuti Karyawan',
            'list' => ['Home', 'Cuti', 'Tambah'],
        ];
        $page = (object)[
            'title' => 'Tambah data cuti karyawan',
        ];
    
        $jenis_sidang = JenisSidang::all(); // Mengambil semua data jenis sidang
        $activeMenu = 'jenis_sidang';
        return view('jenis_sidang.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'jenis_sidang' => $jenis_sidang, 
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jenis_sidang' => 'required|string|max:255',
        ]);

        try {
            //Membuat instance baru menggunakan create
        JenisSidang::create([
                'nama_jenis_sidang' => $validatedData['nama_jenis_sidang'],
            ]);
            return redirect()->route('nama_jenis_sidang.index')->with('succes', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(JenisSidang $jenisSidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JenisSidang $jenisSidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, JenisSidang $jenisSidang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JenisSidang $jenisSidang)
    {
        //
    }
}
