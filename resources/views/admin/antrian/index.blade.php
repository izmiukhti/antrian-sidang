@extends('layouts.template')
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ route('admin.antrian.create') 
}}">Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm"
            id="table_antrian">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Pemohon</th>
                    <th>Nomor Antrian</th>
                    <th>Status Sidang</th>
                    <th>Jadwal Sidang</th>
                    <th>Jenis Sidang</th>
                    <th>Aksi</th>
            </thead>
        </table>
    </div>
</div>
@endsection
@push('css')
@endpush
@push('js')
<script>
    $(document).ready(function() {
        $('#table_antrian').DataTable({
            processing: false,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.antrian.list') }}",
                dataType: 'json', // URL untuk mengambil data
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Mengirimkan token CSRF untuk keamanan
                }
            },
            columns: [
                { data: 'DT_RowIndex', orderable: false, searchable: false }, // Nomor urut
                { data: 'nama_pemohon', name: 'users.name' }, // Nama pemohon dari relasi users
                { data: 'nomor_antrian', name: 'nomor_antrian' },
                { data: 'status_sidang', name: 'status_sidang' },
                { data: 'jadwal_sidang', name: 'jadwal_sidang' },
                { data: 'jenis_sidang', name: 'jenis_sidang.nama_jenis_sidang' }, // Nama jenis sidang dari relasi
                { data: 'aksi', orderable: false, searchable: false } // Tombol aksi
            ],
        });
    });
</script>
@endpush