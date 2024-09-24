@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <ol class="breadcrumb float-sm-right">
                @foreach($breadcrumb->list as $item)
                    <li class="breadcrumb-item">{{ $item }}</li>
                @endforeach
            </ol>
        </div>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.antrian.store') }}" class="form-horizontal">
            @csrf
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Nomor Antrian</label>
                <div class="col-10">
                    <input type="text" class="form-control @error('nomor_antrian') is-invalid @enderror" name="nomor_antrian" value="{{ old('nomor_antrian') }}" required>
                    @error('nomor_antrian')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Status Sidang</label>
                <div class="col-10">
                    <select class="form-control @error('status_sidang') is-invalid @enderror" name="status_sidang" required>
                        <option value="">- Pilih Status -</option>
                        <option value="Pending" {{ old('status_sidang') == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Proses" {{ old('status_sidang') == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ old('status_sidang') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status_sidang')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Jadwal Sidang</label>
                <div class="col-10">
                    <input type="datetime-local" class="form-control @error('jadwal_sidang') is-invalid @enderror" name="jadwal_sidang" value="{{ old('jadwal_sidang') }}" required>
                    @error('jadwal_sidang')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Pemohon</label>
                <div class="col-10">
                    <select class="form-control @error('user_id') is-invalid @enderror" name="user_id" required>
                        <option value="">- Pilih Pemohon -</option>
                        @foreach($users as $user)
                            <option value="{{ $user->user_id }}" {{ old('user_id') == $user->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Jenis Sidang</label>
                <div class="col-10">
                    <select class="form-control @error('jenis_sidang_id') is-invalid @enderror" name="jenis_sidang_id" required>
                        <option value="">- Pilih Jenis Sidang -</option>
                        @foreach($jenis_sidang as $jenis)
                            <option value="{{ $jenis->jenis_sidang_id }}" {{ old('jenis_sidang_id') == $jenis->jenis_sidang_id ? 'selected' : '' }}>{{ $jenis->nama_jenis_sidang }}</option>
                        @endforeach
                    </select>
                    @error('jenis_sidang_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.antrian.index') }}" class="btn btn-default">Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('css')
@endpush

@push('js')
@endpush
