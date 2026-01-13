@extends('bagian.user.rumah.home')
@section('judul', 'User | Tambah Modul')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="card">
                <div class="card-header bg-gradient-primary text-dark text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Modul Baru
                    </h3>
                </div>
                <div class="card-body p-5">
                    <div class="mb-4">
                        <a href="{{ route('user.modul.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali ke Modul
                        </a>
                    </div>

                    <form action="{{ route('user.modul.tambah') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Judul Modul</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>

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

                            <div class="col-md-6">
                                <label>Tahun</label>
                                <input type="text" name="tahun" class="form-control" placeholder="2025" required>
                            </div>

                            <div class="col-12">
                                <label>File Modul (PDF, DOCX, PPTX,)</label>
                                <input type="file" name="fileModul" class="form-control" required
                                    accept=".pdf,.doc,.docx,.ppt,.pptx,.mp4,.jpg,.jpeg,.png,.gif">
                            </div>

                            <div class="col-12">
                                <label>Topik / Keterangan</label>
                                <textarea name="topik" class="form-control" rows="4" placeholder="Opsional..."></textarea>
                            </div>

                            <div class="text-end mt-5">
                                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                                    <i class="fas fa-save me-2"></i> Simpan Modul
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
