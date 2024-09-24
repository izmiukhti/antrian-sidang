@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools"></div>
    </div>
    <div class="card-body">
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible">
                <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible">
                <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('antrian.update', $antrian->antrian_id) }}" class="form-horizontal">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Nomor Antrian</label>
                <div class="col-10">
                    <input type="text" class="form-control" name="nomor_antrian" value="{{ old('nomor_antrian', $antrian->nomor_antrian) }}" required>
                    @error('nomor_antrian')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Status Sidang</label>
                <div class="col-10">
                    <select class="form-control" name="status_sidang" required>
                        <option value="Pending" {{ old('status_sidang', $antrian->status_sidang) == 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Proses" {{ old('status_sidang', $antrian->status_sidang) == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Selesai" {{ old('status_sidang', $antrian->status_sidang) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
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
                    <select class="form-control" name="user_id" required>
                        @foreach($users as $user)
                            <option value="{{ $user->user_id }}" {{ old('user_id', $antrian->user_id) == $user->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
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
                    <select class="form-control" name="jenis_sidang_id" required>
                        @foreach($jenis_sidang as $jenis)
                            <option value="{{ $jenis->jenis_sidang_id }}" {{ old('jenis_sidang_id', $antrian->jenis_sidang_id) == $jenis->jenis_sidang_id ? 'selected' : '' }}>{{ $jenis->nama_jenis_sidang }}</option>
                        @endforeach
                    </select>
                    @error('jenis_sidang_id')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <div class="col-10 offset-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('antrian.index') }}" class="btn btn-secondary">Kembali</a>
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
