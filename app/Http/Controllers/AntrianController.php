<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Antrian;
use App\Models\JenisSidang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class AntrianController extends Controller
{

    public function index()
    {
        $breadcrumb = (object)[
            'title' => 'Data Antrian',
            'list' => ['Home', 'Cuti'],
        ];
        $page = (object)[
            'title' => 'Data antrian yang tersimpan dalam sistem',
        ];
        $antrian = Antrian::with(['jenis_sidang', 'users'])->get();
        $activeMenu = 'antrian';
        return view('admin.antrian.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'antrian' => $antrian, 'activeMenu' => $activeMenu]);
    }

    // show list of antrian$antrians employee
    public function list(Request $request)
    {
    // Mengambil data dari model Antrian beserta relasinya
    $antrians = Antrian::with(['jenis_sidang', 'users']) // Mengambil relasi
        ->select('antrian_id', 'nomor_antrian', 'status_sidang', 'jadwal_sidang', 'jenis_sidang_id', 'user_id'); // Sesuaikan dengan kolom yang diperlukan

    return DataTables::of($antrians)
        ->addIndexColumn() // Menambahkan kolom index
        ->addColumn('nama_pemohon', function ($antrian) {
            // Mengambil nama user dari relasi
            return $antrian->users ? $antrian->users->name : 'Data tidak tersedia';
        })
        ->addColumn('jenis_sidang', function ($antrian) {
            // Mengambil nama jenis sidang dari relasi
            return $antrian->jenis_sidang ? $antrian->jenis_sidang->nama_jenis_sidang : 'Data tidak tersedia';
        })
        ->addColumn('aksi', function ($antrian) {
            // Menambahkan tombol aksi
            $btn = '<a href="' . url('/admin/antrian/' . $antrian->antrian_id) . '" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="' . url('/admin/antrian/' . $antrian->antrian_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form method="POST" action="' . url('/admin/antrian/' . $antrian->antrian_id) . '" class="d-inline-block" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus data ini?\');">';
            $btn .= csrf_field() . method_field('DELETE');
            $btn .= '<button type="submit" class="btn btn-danger btn-sm">Hapus</button>';
            $btn .= '</form>';
            return $btn;
        })
        ->rawColumns(['aksi']) // Menandai bahwa kolom aksi berisi HTML
        ->make(true);
    }


    /**`
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
        $users = User::all(); // Mengambil semua data pengguna
        $jenis_sidang = JenisSidang::all(); // Mengambil semua data jenis sidang
        $activeMenu = 'antrian';
        return view('admin.antrian.create', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'users' => $users, 
            'jenis_sidang' => $jenis_sidang, 
            'activeMenu' => $activeMenu
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validasi form input
    $validatedData = $request->validate([
        'nomor_antrian' => 'required|string|max:255',
        'jadwal_sidang' => 'required|date',
        'jenis_sidang_id' => 'required|integer|exists:jenis_sidangs,jenis_sidang_id',
    ]);

    try {
        // Dapatkan user_id dari session atau user yang login
        $user_id = Auth::id(); // Pastikan user sudah login
        
        // Simpan data ke tabel antrians
        Antrian::create([
            'nomor_antrian' => $validatedData['nomor_antrian'],
            'status_sidang' => 'Pending', // Set default status
            'jadwal_sidang' => $validatedData['jadwal_sidang'],
            'user_id' => $user_id, // Ambil user_id dari session
            'jenis_sidang_id' => $validatedData['jenis_sidang_id'],
        ]);

        return redirect()->route('customers.index')->with('success', 'Antrian berhasil dibuat');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
    }
}

    /**
     * Display the specified resource.
     */
    public function show (Request $request, $id)
    {

        $breadcrumb = (object)[
            'title' => 'Tambah Data Cuti Karyawan',
            'list' => ['Home', 'Cuti', 'Tambah'],
        ];
        $page = (object)[
            'title' => 'Tambah data cuti karyawan',
        ];
       
        $activeMenu = 'antrian';
        $antrian = Antrian::findOrFail($id);
        $users = User::all(); // Mengambil semua data pengguna
        $jenis_sidang = JenisSidang::all();
        return view('admin.antrian.show', [
            'breadcrumb' => $breadcrumb, 
            'page' => $page, 
            'antrian' => $antrian, 
            'activeMenu' => $activeMenu,
            'users' => $users,
            'jenis_sidang' => $jenis_sidang
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
{
    $antrian = Antrian::findOrFail($id);

    $users = User::all(); // Mengambil semua data pengguna
        $jenis_sidang = JenisSidang::all();
    if (!$antrian) {
        return redirect()->route('admin.antrian.index')->with('error', 'Data tidak ditemukan.');
    }

    $breadcrumb = (object)[
        'title' => 'Edit Data Antrian',
        'list' => ['Home', 'Antrian', 'Edit'],
    ];
    $page = (object)[
        'title' => 'Edit Data Antrian',
    ];
    $activeMenu = 'antrian';
    return view('admin.antrian.edit', [
        'breadcrumb' => $breadcrumb,
        'page' => $page,
        'antrian' => $antrian,
        'activeMenu' => $activeMenu,
        'users' => $users,
        'jenis_sidang' => $jenis_sidang
    ]);
}


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Antrian $antrian)
{
    // Validasi data input
    $validatedData = $request->validate([
        'nomor_antrian' => 'required|string|max:255',
        'status_sidang' => 'required|string|max:255',
        'jadwal_sidang' => 'required|date',
        'user_id' => 'required|integer|exists:users,user_id',
        'jenis_sidang_id' => 'required|integer|exists:jenis_sidang,jenis_sidang_id',
    ]);

    try {
        // Perbarui data
        $antrian->update($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('admin.antrian.index')->with('success', 'Data berhasil diperbarui.');
    } catch (\Exception $e) {
        // Tangani kesalahan
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data: ' . $e->getMessage());
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function delete (Request $request, $id)
    {
        try {
            $antrian = Antrian::findOrFail($id);
            $antrian->delete();
            return redirect()->route('admin.antrian.index')->with('success', 'Data berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus data: ' . $e->getMessage());
        }
    }
    
}