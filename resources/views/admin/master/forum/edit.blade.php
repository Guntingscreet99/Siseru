@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Edit Forum Diskusi')
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
                        <div class="mb-4">
                            <a href="{{ url('admin/master/dataforum') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Forum
                            </a>
                        </div>

                        <!-- Form Edit Forum -->
                        <form action="{{ url('admin/forum-edit/' . $forum->kdforum) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row g-4">
                                <!-- Akun Pembuat -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="akun" class="form-label fw-bold">Akun Pembuat</label>
                                        <input type="text" name="akun" id="akun"
                                            class="form-control @error('akun') is-invalid @enderror"
                                            value="{{ old('akun', $forum->akun) }}" required>
                                        @error('akun')
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                                    {{ old('id_kelas', $forum->id_kelas) == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kelas')
                                            <div class="invalid-feedback">{{ $message }}</div>
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
                                                    {{ old('id_semester', $forum->id_semester) == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_semester }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_semester')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Tahun Ajaran -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="tahun" class="form-label fw-bold">Tahun Ajaran</label>
                                        <input type="text" name="tahun" id="tahun"
                                            class="form-control @error('tahun') is-invalid @enderror"
                                            value="{{ old('tahun', $forum->tahun) }}" placeholder="Contoh: 2025/2026"
                                            required>
                                        @error('tahun')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Topik Diskusi -->
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="topik" class="form-label fw-bold">Topik Diskusi</label>
                                        <textarea name="topik" id="topik" rows="6" class="form-control @error('topik') is-invalid @enderror"
                                            required>{{ old('topik', $forum->topik) }}</textarea>
                                        @error('topik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Durasi Diskusi (Fitur Baru!) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="durasi_menit" class="form-label fw-bold text-primary">
                                            Durasi Diskusi (menit)
                                        </label>
                                        <input type="number" name="durasi_menit" id="durasi_menit" min="5"
                                            max="1440" step="5"
                                            class="form-control form-control-lg @error('durasi_menit') is-invalid @enderror"
                                            value="{{ old('durasi_menit', $forum->durasi_menit ?? 60) }}" required>
                                        <small class="form-text text-muted">
                                            Saat diubah, waktu selesai akan otomatis dihitung ulang dari sekarang.
                                        </small>
                                        @error('durasi_menit')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- File Saat Ini -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label fw-bold">File Saat Ini</label>
                                        <div class="border rounded p-3 bg-light text-center">
                                            @if ($forum->fileForum)
                                                @php
                                                    $ext = pathinfo($forum->fileForum, PATHINFO_EXTENSION);
                                                    $url = asset('storage/' . $forum->fileForum);
                                                @endphp
                                                @if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                    <img src="{{ $url }}" class="img-thumbnail"
                                                        style="max-height: 120px;">
                                                @elseif($ext === 'pdf')
                                                    <a href="{{ $url }}" target="_blank"
                                                        class="btn btn-sm btn-danger">
                                                        <i class="fas fa-file-pdf"></i> Lihat PDF
                                                    </a>
                                                @elseif(in_array(strtolower($ext), ['mp4', 'avi', 'mkv', 'mov']))
                                                    <div class="badge bg-info fs-6 p-2">
                                                        <i class="fas fa-video"></i> Video Terlampir
                                                    </div>
                                                @else
                                                    <a href="{{ $url }}" target="_blank"
                                                        class="btn btn-sm btn-success">
                                                        <i class="fas fa-download"></i> Unduh File
                                                    </a>
                                                @endif
                                                <br>
                                                <small class="text-muted d-block mt-2">
                                                    {{ $forum->judulFileAsli ?? 'File terlampir' }}
                                                </small>
                                            @else
                                                <span class="text-muted">Tidak ada file terlampir</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <!-- Ganti File (Opsional) -->
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="fileForum" class="form-label fw-bold">Ganti File Forum (Kosongkan jika
                                            tidak ingin ganti)</label>
                                        <input type="file" name="fileForum" id="fileForum"
                                            class="form-control @error('fileForum') is-invalid @enderror"
                                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.jpg,.jpeg,.png,.mp4,.avi,.mkv">
                                        <small class="form-text text-muted">
                                            Format: PDF, Word, Excel, PowerPoint, Gambar, atau Video
                                        </small>
                                        @error('fileForum')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Tombol Simpan & Batal -->
                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-save"></i> Update Forum
                                </button>
                                <a href="{{ url('admin/master/dataforum') }}" class="btn btn-secondary btn-lg px-5">
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
