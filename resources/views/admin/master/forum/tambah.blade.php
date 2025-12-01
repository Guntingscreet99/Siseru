@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Tambah Forum Diskusi')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>

                <div class="card">
                    <div class="card-body">

                        <!-- Tombol Kembali -->
                        <div class="mb-4" style="display: flex; justify-content: space-between; align-items: center;">
                            <a href="{{ route('admin.master.forum') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar
                            </a>
                        </div>

                        <!-- Form Tambah Forum -->
                        <form action="{{ route('admin.forum.tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row g-4">
                                <!-- Akun Pembuat -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="akun" class="form-label fw-bold">Akun Pembuat</label>
                                        <input type="text" name="akun" id="akun"
                                            class="form-control @error('akun') is-invalid @enderror"
                                            placeholder="Contoh: Budi Santoso" value="{{ old('akun') }}" required>
                                        @error('akun')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kelas -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_kelas" class="form-label fw-bold">Kelas</label>
                                        <select name="id_kelas" id="id_kelas"
                                            class="form-control @error('id_kelas') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ old('id_kelas') == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kelas')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Semester -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="id_semester" class="form-label fw-bold">Semester</label>
                                        <select name="id_semester" id="id_semester"
                                            class="form-control @error('id_semester') is-invalid @enderror" required>
                                            <option value="">-- Pilih Semester --</option>
                                            @foreach ($semester as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ old('id_semester') == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_semester }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_semester')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tahun Ajaran -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tahun" class="form-label fw-bold">Tahun Ajaran</label>
                                        <input type="text" name="tahun" id="tahun"
                                            class="form-control @error('tahun') is-invalid @enderror"
                                            placeholder="Contoh: 2025/2026" value="{{ old('tahun') }}" required>
                                        @error('tahun')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Topik Diskusi -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="topik" class="form-label fw-bold">Topik Diskusi</label>
                                        <textarea name="topik" id="topik" rows="5" class="form-control @error('topik') is-invalid @enderror"
                                            placeholder="Tulis topik atau pertanyaan yang akan didiskusikan..." required>{{ old('topik') }}</textarea>
                                        @error('topik')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Durasi Diskusi (FITUR BARU!) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="durasi_menit" class="form-label fw-bold text-primary">
                                            Durasi Diskusi (menit)
                                        </label>
                                        <input type="number" name="durasi_menit" id="durasi_menit" min="5"
                                            max="4320" step="5"
                                            class="form-control form-control-lg @error('durasi_menit') is-invalid @enderror"
                                            value="{{ old('durasi_menit', 60) }}" required>
                                        <small class="text-muted">
                                            Default: 60 menit (1 jam). Maksimal 3 hari (4320 menit)
                                        </small>
                                        @error('durasi_menit')
                                            <span class="text-danger small d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- File Pendukung -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fileForum" class="form-label fw-bold">File Pendukung (Opsional)</label>
                                        <input type="file" name="fileForum" id="fileForum"
                                            class="form-control @error('fileForum') is-invalid @enderror"
                                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.mp4,.avi,.mkv">
                                        <small class="text-muted">
                                            PDF, Word, Excel, PPT, Gambar, atau Video
                                        </small>
                                        @error('fileForum')
                                            <span class="text-danger small d-block">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <hr class="my-5">

                            <!-- Tombol Simpan -->
                            <div class="text-center">
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="fas fa-save"></i> Simpan Forum Diskusi
                                </button>
                                <a href="{{ route('admin.master.forum') }}" class="btn btn-secondary btn-lg px-5">
                                    Batal
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
