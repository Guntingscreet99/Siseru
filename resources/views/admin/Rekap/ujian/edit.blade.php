@extends('bagian.admin.rumah.home')
@section('judul', 'Edit Nilai Ujian')
@section('isi')

<div class="container">
    <div class="page-inner">
        <div class="guru">
            <div class="judul">
                <h1>Edit Nilai Ujian</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <!-- Tombol Kembali -->
                    <div class="mb-3">
                        <a href="{{ url('admin/rekap/ujian') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Rekap Ujian
                        </a>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 mx-auto">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('admin.rekap.ujian.update', $rekap->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">NIM</label>
                                        <input type="text" class="form-control" value="{{ $rekap->user->datadiri->nim ?? '-' }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Nama Lengkap</label>
                                        <input type="text" class="form-control" value="{{ $rekap->user->nama_lengkap ?? '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Kelas</label>
                                        <input type="text" class="form-control" value="{{ $rekap->user->datadiri->kelas->nama_kelas ?? '-' }}" readonly>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label fw-bold">Semester</label>
                                        <input type="text" class="form-control" value="{{ $rekap->user->datadiri->semester->nama_semester ?? '-' }}" readonly>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="judul" class="form-label fw-bold">Judul Ujian</label>
                                    <input type="text" name="judul" id="judul" class="form-control"
                                           value="{{ old('judul', $rekap->ujian->nama_ujian ?? '') }}" required>
                                </div>

                                <div class="mb-4">
                                    <label for="nilai" class="form-label fw-bold">Nilai</label>
                                    <input type="number" name="nilai" id="nilai" class="form-control"
                                           min="0" max="100" step="0.01"
                                           value="{{ old('nilai', $rekap->nilai ?? '') }}" required>
                                    <small class="text-muted">Nilai antara 0 - 100</small>
                                </div>

                                <hr>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success btn-lg px-5">
                                        <i class="fas fa-save"></i> Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
