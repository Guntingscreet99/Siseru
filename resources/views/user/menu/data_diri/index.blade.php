@extends('bagian.admin.rumah.home')
@section('judul', 'Update Data Diri')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3" style="display: flex; justify-content: space-between">
                            <div class="form-group">
                                <a href="{{ url('mahasiswa/dashboard') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form class="pt-3" method="POST" action="{{ url('mahasiswa/data-diri/simpan/' . $user->id) }}"
                            enctype="multipart/form-data" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="d-flex flex-column flex-md-row align-items-center gap-4">
                                    <!-- Area Pratinjau Foto -->
                                    <div class="text-center">
                                        <img src="{{ asset('admin/img/profile.jpg') }}" alt="Foto Profil"
                                            class="rounded-circle shadow-sm img-fluid"
                                            style="width: 120px; height: 120px; object-fit: cover;" id="previewFoto">
                                    </div>
                                    <!-- Area Input dan Tombol -->
                                    <div class="d-flex flex-column align-items-start">
                                        <label class="btn btn-info mb-3 d-flex align-items-center gap-2">
                                            <i class="bi bi-upload"></i> <!-- Ikon Bootstrap Icons -->
                                            <span class="text-white">Unggah Foto</span>
                                            <input type="file" name="fotoMhs" id="fotoMhs" class="d-none"
                                                accept="image/png, image/jpg, image/jpeg" onchange="previewFoto(event)">
                                        </label>
                                        <button type="button"
                                            class="btn btn-outline-secondary mb-3 d-flex align-items-center gap-2"
                                            onclick="resetFoto()">
                                            <i class="bi bi-arrow-counterclockwise"></i> <!-- Ikon Reset -->
                                            Reset
                                        </button>
                                        <small class="text-muted mb-2">Format: JPEG, JPG, PNG. Maks. 2 MB</small>
                                        @error('fotoMhs')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">NIM</label>
                                        <input type="text" class="form-control" name="nim" id="nim"
                                            placeholder="nim" value="{{ $user->nim ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                            placeholder="Nama Lengkap" value="{{ $user->nama_lengkap ?? '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            value="{{ $user->email ?? '' }}" placeholder="@gmail.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No. Hp</label>
                                        <input type="text" class="form-control" name="no_hp" id="no_hp"
                                            value="{{ $user->no_hp ?? '' }}" placeholder="081......">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tempat</label>
                                        <input type="text" class="form-control" name="tempat" id="exampleInputTempat"
                                            value="{{ $user->datadiri->tempat ?? '' }}" placeholder="Tempat Lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tgllahir"
                                            value="{{ $user->datadiri->tgllahir ?? '' }}" id="exampleInputTanggalLahir">
                                    </div>
                                </div>

                                @php
                                    $data = $user->datadiri;
                                    $isFirstTime =
                                        !$data ||
                                        is_null($data->jenisKelamin) ||
                                        is_null($data->id_kelas) ||
                                        is_null($data->id_semester);
                                @endphp

                                <!-- Jenis Kelamin -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Jenis Kelamin {!! $isFirstTime ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <select name="jenisKelamin" id="jenisKelamin"
                                            class="form-control @error('jenisKelamin') is-invalid @enderror" required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-laki"
                                                {{ old('jenisKelamin', $data?->jenisKelamin) == 'Laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="Perempuan"
                                                {{ old('jenisKelamin', $data?->jenisKelamin) == 'Perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                        @error('jenisKelamin')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Kelas -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Kelas {!! $isFirstTime ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <select name="id_kelas" id="id_kelas"
                                            class="form-control @error('id_kelas') is-invalid @enderror" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_kelas', $data?->id_kelas) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_kelas')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Semester -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Semester {!! $isFirstTime ? '<span class="text-danger">*</span>' : '' !!}</label>
                                        <select name="id_semester" id="id_semester"
                                            class="form-control @error('id_semester') is-invalid @enderror" required>
                                            <option value="">-- Pilih Semester --</option>
                                            @foreach ($semester as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ old('id_semester', $data?->id_semester) == $item->id ? 'selected' : '' }}>
                                                    {{ $item->nama_semester }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('id_semester')
                                            <div class="text-danger small">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Alert khusus pertama kali isi -->
                                @if ($isFirstTime)
                                    <div class="col-12 mb-3">
                                        <div class="alert alert-info">
                                            <i class="fas fa-info-circle"></i>
                                            <strong>Perhatian:</strong> Harap lengkapi Jenis Kelamin, Kelas, dan Semester
                                            terlebih dahulu.
                                            Setelah disimpan, data ini tetap bisa diubah kapan saja.
                                        </div>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30"
                                            rows="5" placeholder="Masukkan Alamat">{{ $user->datadiri->alamat ?? '' }}</textarea>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-warning btn-lg font-weight-medium auth-form-btn">Simpan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        function previewFoto(event) {
            const input = event.target;
            const preview = document.getElementById('previewFoto');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function resetFoto() {
            const preview = document.getElementById('previewFoto');
            preview.src = "{{ asset('admin/img/profile.jpg') }}"; // Kembalikan ke gambar default
            document.getElementById('foto').value = ''; // Reset input file
        }
    </script>
@endpush
