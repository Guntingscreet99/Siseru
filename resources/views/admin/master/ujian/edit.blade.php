@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Edit Data Ujian')
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

                        <form action="{{ route('admin.ujian.edit', $ujian->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">

                                {{-- NAMA UJIAN --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Nama Ujian</label>
                                    <input type="text" name="ujian"
                                        class="form-control @error('ujian') is-invalid @enderror"
                                        value="{{ old('ujian', $ujian->ujian) }}" required>
                                    @error('ujian')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- LINK --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Link Ujian</label>
                                    <input type="url" name="link"
                                        class="form-control @error('link') is-invalid @enderror"
                                        value="{{ old('link', $ujian->link) }}">
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- KELAS --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Kelas</label>
                                    <select name="id_kelas" class="form-control">
                                        @foreach ($kelas as $k)
                                            <option value="{{ $k }}"
                                                {{ old('id_kelas', $ujian->kelas) == $k ? 'selected' : '' }}>
                                                {{ $k }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- SEMESTER --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Semester</label>
                                    <select name="id_semester" class="form-control">
                                        @foreach ($semester as $s)
                                            <option value="{{ $s }}"
                                                {{ old('id_semester', $ujian->semester) == $s ? 'selected' : '' }}>
                                                {{ $s }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- WAKTU MULAI --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Waktu Mulai</label>
                                    <input type="datetime-local" name="waktu_mulai" class="form-control"
                                        value="{{ old('waktu_mulai', optional($ujian->waktu_mulai)->format('Y-m-d\TH:i')) }}">
                                </div>

                                {{-- DURASI --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Durasi (menit)</label>
                                    <input type="number" name="durasi_menit" class="form-control"
                                        value="{{ old('durasi_menit', $ujian->durasi_menit) }}">
                                </div>

                            </div>

                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-save"></i> Update
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
