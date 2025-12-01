@extends('bagian.user.rumah.home')
@section('judul', 'Edit Karya Saya')

@section('isi')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                    <div class="card-header bg-gradient-warning text-dark text-center py-4">
                        <h3 class="mb-0">
                            <i class="fas fa-edit me-2"></i>
                            Edit Karya: {{ $karya->namaKarya }}
                        </h3>
                    </div>

                    <div class="card-body p-5">
                        <div class="mb-4">
                            <a href="{{ route('user.galeri.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>

                        <form action="{{ route('user.galeri.edit', $karya->kdkarya) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Nama Mahasiswa (Readonly) -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label class="form-label fw-bold text-muted">Pembuat Karya</label>
                                    <input type="text" class="form-control form-control-lg bg-light"
                                        value="{{ $karya->namaMhs }}" readonly>
                                    <small class="text-muted">Tidak dapat diubah</small>
                                </div>
                            </div>

                            <div class="row g-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Nama Karya</label>
                                    <input type="text" name="namaKarya" class="form-control form-control-lg"
                                        value="{{ old('namaKarya', $karya->namaKarya) }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Kelas</label>
                                    <select name="id_kelas" class="form-select form-select-lg" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k->id }}"
                                                {{ $karya->id_kelas == $k->id ? 'selected' : '' }}>
                                                {{ $k->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">Semester</label>
                                    <select name="id_semester" class="form-select form-select-lg" required>
                                        <option value="">-- Pilih Semester --</option>
                                        @foreach ($semester as $s)
                                            <option value="{{ $s->id }}"
                                                {{ $karya->id_semester == $s->id ? 'selected' : '' }}>
                                                {{ $s->nama_semester }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold">File Saat Ini</label>
                                    @if ($karya->fileKarya)
                                        <div class="border rounded-3 p-3 bg-light">
                                            <p class="mb-2">
                                                <i class="fas fa-file-image text-primary me-2"></i>
                                                <a href="{{ Storage::url($karya->fileKarya) }}" target="_blank">
                                                    {{ $karya->judulFileAsli }}
                                                </a>
                                            </p>
                                            <small class="text-muted">Biarkan kosong jika tidak ingin ganti file</small>
                                        </div>
                                    @else
                                        <p class="text-muted">Tidak ada file</p>
                                    @endif

                                    <label class="form-label fw-bold mt-3">Ganti File (Opsional)</label>
                                    <input type="file" name="fileKarya" class="form-control form-control-lg"
                                        accept="image/*,video/mp4,video/mkv,video/avi">
                                </div>

                                <div class="col-12">
                                    <label class="form-label fw-bold">Deskripsi Karya</label>
                                    <textarea name="deskripsi" rows="6" class="form-control form-control-lg">{{ old('deskripsi', $karya->deskripsi) }}</textarea>
                                </div>
                            </div>

                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-warning btn-lg px-5 shadow">
                                    <i class="fas fa-save me-2"></i> Update Karya
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
