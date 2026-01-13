@extends('bagian.admin.rumah.home')
@section('judul', 'Import Data Ujian')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>Import Data Ujian dari Spreadsheet</h1>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- Tombol Kembali -->
                        <div class="mb-3">
                            <a href="{{ route('admin.rekap.ujian') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Rekap Ujian
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-lg-8 mx-auto">

                                <!-- Alert Success / Error -->
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Gagal import:</strong> {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                    </div>
                                @endif

                                <!-- Tampilkan detail baris yang gagal (jika ada) -->
                                @if (session()->has('failures'))
                                    <div class="alert alert-warning">
                                        <h6 class="fw-bold">Baris yang gagal diimport:</h6>
                                        <ul class="mb-0">
                                            @foreach (session('failures') as $failure)
                                                <li>
                                                    Baris {{ $failure->row() }}:
                                                    {{ implode(', ', $failure->errors()) }}
                                                    (Kolom: {{ implode(', ', $failure->attribute()) }})
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <!-- Form Import -->
                                <form action="{{ route('admin.import.ujian.store') }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-4 text-center">
                                        <h5 class="fw-bold mb-3">
                                            Upload File Excel / CSV dari Google Form
                                        </h5>
                                        <p class="text-muted small">
                                            Pastikan file memiliki header kolom seperti:<br>
                                            <strong>NIM, Nama Lengkap, Kelas, Semester, Judul Ujian, Nilai</strong><br>
                                            (Urutan kolom bebas, sistem akan membaca berdasarkan nama header)
                                        </p>
                                    </div>

                                    <div class="mb-3">
                                        <label for="file" class="form-label fw-bold">Pilih File Excel/CSV</label>
                                        <input type="file" name="file" id="file" class="form-control"
                                            accept=".xlsx,.xls,.csv" required>
                                        <div class="form-text text-muted">
                                            Maksimal 10MB. Format: XLSX, XLS, atau CSV
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="judul_ujian" class="form-label fw-bold">Judul Ujian (Default)</label>
                                        <input type="text" name="judul_ujian" id="judul_ujian" class="form-control"
                                            placeholder="Contoh: Ujian Tengah Semester Genap 2025/2026"
                                            value="{{ old('judul_ujian') }}" required>
                                        <div class="form-text text-muted">
                                            Akan digunakan jika kolom "Judul Ujian" tidak ada di file
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-lg px-5">
                                            <i class="fas fa-upload"></i> Import Data Sekarang
                                        </button>
                                    </div>
                                </form>

                                <!-- Template Download -->
                                <div class="mt-5 text-center border-top pt-4">
                                    <p class="text-muted mb-3">
                                        Belum punya format file yang benar?
                                    </p>
                                    <a href="{{ asset('template/template_ujian.xlsx') }}" class="btn btn-outline-success"
                                        download>
                                        <i class="fas fa-download"></i> Download Template Excel
                                    </a>
                                    <small class="d-block text-muted mt-2">
                                        Isi sesuai contoh, lalu upload kembali
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
