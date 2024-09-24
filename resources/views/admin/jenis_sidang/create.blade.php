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
        <form method="POST" action="{{ route('jenis_sidang.store') }}" class="form-horizontal">
            @csrf
            <div class="form-group row">
                <label class="col-2 control-label col-form-label">Jenis Sidang</label>
                <div class="col-10">
                    <input type="text" class="form-control @error('nama_jenis_sidang') is-invalid @enderror" name="nama_jenis_sidang" value="{{ old('jenis_sidang') }}" required>
                    @error('nama_jenis_sidang')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-12 text-right">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('jenis_sidang.index') }}" class="btn btn-default">Kembali</a>
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
