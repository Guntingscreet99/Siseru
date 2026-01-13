@extends('bagian.user.rumah.home')
@section('judul', 'User | Edit Modul')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="card">
                <div class="card-header bg-gradient-warning text-dark text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Modul: {{ $modul->judul }}
                    </h3>
                </div>
                <div class="card-body">

                    <!-- Tombol Kembali -->
                    <div class="mb-4">
                        <a href="{{ route('user.modul.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    {{-- <h4 class="mb-4 text-primary">Edit Modul: {{ $modul->judul }}</h4> --}}

                    <!-- Form Edit -->
                    <form action="{{ route('user.modul.edit', $modul->kdmodul) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <!-- Judul -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Judul Modul</label>
                                <input type="text" name="judul" class="form-control"
                                    value="{{ old('judul', $modul->judul) }}" required>
                            </div>

                            <!-- Kelas — HANYA TAMPILKAN, TIDAK BISA DIUBAH -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kelas</label>
                                <input type="text" class="form-control bg-light"
                                    value="{{ $modul->kelas?->nama_kelas ?? 'Tidak diketahui' }}" readonly>
                                <small class="text-muted">Kelas tidak dapat diubah</small>
                            </div>

                            <!-- Semester — HANYA TAMPILKAN -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Semester</label>
                                <input type="text" class="form-control bg-light"
                                    value="{{ $modul->semester?->nama_semester ?? 'Tidak diketahui' }}" readonly>
                                <small class="text-muted">Semester tidak dapat diubah</small>
                            </div>

                            <!-- Tahun -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Tahun</label>
                                <input type="text" name="tahun" class="form-control"
                                    value="{{ old('tahun', $modul->tahun) }}" placeholder="2025" required>
                            </div>

                            <!-- File Modul Saat Ini -->
                            <div class="col-12">
                                <label class="form-label fw-bold">File Saat Ini</label>
                                @if ($modul->fileModul)
                                    <div class="alert alert-info py-2">
                                        <i class="fas fa-file"></i>
                                        <a href="{{ Storage::url($modul->fileModul) }}" target="_blank"
                                            class="text-decoration-none">
                                            {{ $modul->judulFileAsli ?? 'Lihat File' }}
                                        </a>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="gunakan_file_lama"
                                            id="gunakan_file_lama" checked>
                                        <label class="form-check-label text-success" for="gunakan_file_lama">
                                            Biarkan file tetap (centang ini jika tidak ingin ganti file)
                                        </label>
                                    </div>
                                @else
                                    <p class="text-muted">Tidak ada file terunggah</p>
                                @endif
                            </div>

                            <!-- Upload File Baru (Opsional) -->
                            <div class="col-12">
                                <label class="form-label">Ganti File (Kosongkan jika tidak ingin ganti)</label>
                                <input type="file" name="fileModul" class="form-control"
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.mp4,.jpg,.jpeg,.png,.gif,.webp">
                            </div>

                            <!-- Topik -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Topik / Keterangan</label>
                                <textarea name="topik" class="form-control" rows="4" placeholder="Opsional...">{{ old('topik', $modul->topik) }}</textarea>
                            </div>

                            <!-- Tombol Simpan -->
                            <div class="text-end mt-4">
                                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                                    <i class="fas fa-save me-2"></i> Perbarui Modul
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
