@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(!$antrian)
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                Data yang Anda cari tidak ditemukan.
            </div>
        @else
            <table class="table table-bordered table-striped table-hover table-sm">
                <tr>
                    <th>ID</th>
                    <td>{{ $antrian->antrian_id }}</td>
                </tr>
                <tr>
                    <th>Nomor Antrian</th>
                    <td>{{ $antrian->nomor_antrian }}</td>
                </tr>
                <tr>
                    <th>Status Sidang</th>
                    <td>{{ $antrian->status_sidang }}</td>
                </tr>
                <tr>
                    <th>Jadwal Sidang</th>
                    <td>{{ $antrian->jadwal_sidang }}</td>
                </tr>
                <tr>
                    <th>Pemohon</th>
                    <td>{{ $antrian->user ? $antrian->user->name : 'Data tidak tersedia' }}</td>
                </tr>
                <tr>
                    <th>Jenis Sidang</th>
                    <td>{{ $antrian->jenisSidang ? $antrian->jenisSidang->nama_jenis_sidang : 'Data tidak tersedia' }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ url('antrian') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
