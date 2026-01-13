@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Tambah Data Ujian')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul mb-3">
                    <h1>@yield('judul')</h1>
                </div>

                <div class="card">
                    <div class="card-body">

                        <a href="{{ route('admin.ujian.index') }}" class="btn btn-primary mb-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        <form action="{{ url('admin/ujian-tambah') }}" method="POST">
                            @csrf

                            <div class="row">

                                {{-- NAMA UJIAN --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Ujian</label>
                                    <input type="text" name="ujian"
                                        class="form-control @error('ujian') is-invalid @enderror"
                                        value="{{ old('ujian') }}" required>
                                    @error('ujian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- LINK --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Link Ujian (Opsional)</label>
                                    <input type="url" name="link"
                                        class="form-control @error('link') is-invalid @enderror"
                                        value="{{ old('link') }}">
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- KELAS --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Kelas</label>
                                    <select name="id_kelas" class="form-control @error('id_kelas') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach ($kelas as $kel)
                                            <option value="{{ $kel->id }}"
                                                {{ old('id_kelas', $kel?->id_kelas) == $kel->id ? 'selected' : '' }}>
                                                {{ $kel->nama_kelas }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_kelas')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- SEMESTER --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Semester</label>
                                    <select name="id_semester" class="form-control @error('semester') is-invalid @enderror"
                                        required>
                                        <option value="">-- Pilih Semester --</option>
                                        @foreach ($semester as $sems)
                                            <option value="{{ $sems->id }}"
                                                {{ old('id_semester', $sems?->id_semester) == $sems->id ? 'selected' : '' }}>
                                                {{ $sems->nama_semester }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_semester')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- WAKTU MULAI --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Waktu Mulai</label>
                                    <input type="datetime-local" name="waktu_mulai"
                                        class="form-control @error('waktu_mulai') is-invalid @enderror"
                                        value="{{ old('waktu_mulai') }}">
                                    @error('waktu_mulai')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- DURASI --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Durasi (menit)</label>
                                    <input type="number" name="durasi_menit"
                                        class="form-control @error('durasi_menit') is-invalid @enderror"
                                        value="{{ old('durasi_menit', 60) }}" min="1">
                                    @error('durasi_menit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Simpan
                            </button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
