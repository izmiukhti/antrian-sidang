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
                    <td>{{ $customers->customer_id }}</td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td>{{ $customers->nama_customers }}</td>
                </tr>
                <tr>
                    <th>Status Sidang</th>
                    <td>{{ $customers->status_sidang }}</td>
                </tr>
                <tr>
                    <th>Jadwal Sidang</th>
                    <td>{{ $customers->jadwal_sidang }}</td>
                </tr>
                    <th>Jenis Sidang</th>
                    <td>{{ $customers->jenisSidang ? $customers->jenisSidang->nama_jenis_sidang : 'Data tidak tersedia' }}</td>
                </tr>
            </table>
        @endif
        <a href="{{ url('customers') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
    </div>
</div>
@endsection
