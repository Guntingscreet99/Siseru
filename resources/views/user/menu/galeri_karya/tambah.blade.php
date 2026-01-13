@extends('bagian.user.rumah.home')
@section('judul', 'Tambah Karya')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-dark text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Unggah Karya Baru
                    </h3>
                </div>

                <div class="card-body p-5">
                    <div class="mb-4">
                        <a href="{{ route('user.galeri.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Galeri
                        </a>
                    </div>

                    <form action="{{ route('user.galeri.tambah') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Nama Mahasiswa</label>
                                <input type="text" class="form-control" name="namaMhs"
                                    value="{{ $user->nama_lengkap ?? 'Mahasiswa' }}" readonly>
                                <small class="text-muted">Otomatis dari Data Diri Anda</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">NIM</label>
                                <input type="text" name="nim" id="nim" class="form-control"
                                    value="{{ $user->nim ?? 'Belum diatur' }}" readonly>
                            </div>

                            <!-- Kelas & Semester dari form (user bisa pilih sendiri) -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Kelas <span class="text-danger">*</span></label>
                                <select name="id_kelas" class="form-select @error('id_kelas') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach (\App\Models\Kelas::all() as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('id_kelas', auth()->user()->datadiri?->id_kelas) == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_kelas')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Semester <span class="text-danger">*</span></label>
                                <select name="id_semester" class="form-select @error('id_semester') is-invalid @enderror"
                                    required>
                                    <option value="">-- Pilih Semester --</option>
                                    @foreach (\App\Models\Semester::all() as $s)
                                        <option value="{{ $s->id }}"
                                            {{ old('id_semester', auth()->user()->datadiri?->id_semester) == $s->id ? 'selected' : '' }}>
                                            {{ $s->nama_semester }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_semester')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Sisanya tetap sama: Nama Karya, File, Deskripsi, dll -->
                            <div class="row g-4 mt-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Karya <span class="text-danger">*</span></label>
                                    <input type="text" name="namaKarya"
                                        class="form-control form-control @error('namaKarya') is-invalid @enderror"
                                        placeholder="Contoh: Poster Lingkungan Hidup" required>
                                    @error('namaKarya')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">File Karya (Gambar/Video) <span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="fileKarya"
                                        class="form-control form-control @error('fileKarya') is-invalid @enderror"
                                        accept="image/*,video/mp4,video/mkv,video/avi" required>
                                    <small class="text-muted">Maks. 50MB • Format: JPG, PNG, MP4, MKV, AVI</small>
                                    @error('fileKarya')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Deskripsi Karya <span
                                            class="text-danger">*</span></label>
                                    <textarea name="deskripsi" rows="5" class="form-control form-control @error('deskripsi') is-invalid @enderror"
                                        placeholder="Ceritakan tentang karya Anda... (bahan, teknik, inspirasi, dll)" required>{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                                    <i class="fas fa-save me-2"></i> Simpan Karya
                                </button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
