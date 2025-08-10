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
                        <form class="pt-3" method="POST" action="{{ url('mahasiswa/data-diri/simpan') }}"
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
                                            <input type="file" name="foto" id="foto" class="d-none"
                                                accept="image/png, image/jpg, image/jpeg" onchange="previewFoto(event)">
                                        </label>
                                        <button type="button"
                                            class="btn btn-outline-secondary mb-3 d-flex align-items-center gap-2"
                                            onclick="resetFoto()">
                                            <i class="bi bi-arrow-counterclockwise"></i> <!-- Ikon Reset -->
                                            Reset
                                        </button>
                                        <small class="text-muted mb-2">Format: JPEG, JPG, PNG. Maks. 2 MB</small>
                                        @error('foto')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Username</label>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Username" value="{{ $user->username ?? '-' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Nama Lengkap</label>
                                        <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap"
                                            placeholder="Nama Lengkap" value="{{ $user->nama_lengkap ?? '-' }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="email" class="form-control" name="email" id="email"
                                            placeholder="@gmail.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">No. Hp</label>
                                        <input type="text" class="form-control" name="no_hp" id="no_hp"
                                            placeholder="081......">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tempat</label>
                                        <input type="text" class="form-control" name="tempat" id="exampleInputTempat"
                                            placeholder="Tempat Lahir">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tgllahir"
                                            id="exampleInputTanggalLahir">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Jenis Kelamin</label>
                                        <select name="jenisKelamin" id="jenisKelamin" class="form-control">
                                            <option value="">-- Jenis Kelamin --</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Kelas</label>
                                        <select name="id_kelas" id="id_kelas" class="form-control">
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach ($kelas as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Semester</label>
                                        <select name="id_semester" id="id_semester" class="form-control">
                                            <option value="">-- Pilih Semester --</option>
                                            @foreach ($semester as $item)
                                                <option value="{{ $item->id }}">{{ $item->nama_semester }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat" cols="30"
                                            rows="5" placeholder="Masukkan Alamat"></textarea>
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
