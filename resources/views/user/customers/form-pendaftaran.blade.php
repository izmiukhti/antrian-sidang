<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Form Pendaftaran</title>
</head>

<body>

    <div class="container mt-5">
        <h2>Form Pendaftaran</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('user.customers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama"
                    required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email"
                    required>
            </div>

            <div class="mb-3">
                <label for="notlp" class="form-label">No Telp</label>
                <input type="text" class="form-control" id="notlp" name="notlp" placeholder="Masukkan No Telp"
                    required>
            </div>


            <!-- Tambahkan jadwal sidang -->
            <div class="mb-3">
                <label for="jadwal_sidang" class="form-label">Jadwal Sidang</label>
                <input type="datetime-local" class="form-control" id="jadwal_sidang" name="jadwal_sidang" required>
            </div>

            <div class="mb-3">
                <label for="jenis_sidang_id" class="form-label">Jenis Sidang</label>
                <select class="form-select" id="jenis_sidang_id" name="jenis_sidang_id" required>
                    <option value="">Pilih Jenis Sidang</option>
                    @foreach ($jenisSidang as $sidang)
                        <option value="{{ $sidang->jenis_sidang_id }}">{{ $sidang->nama_jenis_sidang }}</option>
                    @endforeach
                </select>
            </div>


            <div class="mb-3">
                <label for="ktp_file" class="form-label">Upload KTP</label>
                <input type="file" class="form-control" id="ktp_file" name="ktp_file" required>
            </div>

            <div class="mb-3">
                <label for="kk_file" class="form-label">Upload KK</label>
                <input type="file" class="form-control" id="kk_file" name="kk_file" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="terms" required>
                <label class="form-check-label" for="terms">Saya setuju dengan syarat dan ketentuan</label>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Daftar</button>
        </form>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>