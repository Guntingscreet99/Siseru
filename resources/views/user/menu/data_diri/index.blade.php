@extends('bagian.admin.rumah.home')
@section('judul', 'Update Data Diri')
@section('isi')

    @php
        $fotoPath = $user->datadiri?->fotoMhs
            ? asset('storage/' . $user->datadiri->fotoMhs)
            : asset('admin/img/profile.jpg');
    @endphp

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
                            enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                <!-- ================= FOTO ================= -->
                                <div class="d-flex flex-column flex-md-row align-items-center gap-4 mb-4">

                                    <div class="text-center">
                                        <img src="{{ $fotoPath }}" alt="Foto Profil"
                                            class="rounded-circle shadow-sm img-fluid"
                                            style="width: 120px; height: 120px; object-fit: cover;" id="previewFoto">
                                    </div>

                                    <div class="d-flex flex-column align-items-start">
                                        <label class="btn btn-info mb-3 d-flex align-items-center gap-2">
                                            <i class="bi bi-upload"></i>
                                            <span class="text-white">Unggah Foto</span>
                                            <input type="file" name="fotoMhs" id="fotoMhs" class="d-none"
                                                accept="image/png, image/jpg, image/jpeg" onchange="previewFoto(event)">
                                        </label>

                                        <button type="button"
                                            class="btn btn-outline-secondary mb-3 d-flex align-items-center gap-2"
                                            onclick="resetFoto()">
                                            <i class="bi bi-arrow-counterclockwise"></i>
                                            Reset
                                        </button>

                                        <small class="text-muted mb-2">Format: JPEG, JPG, PNG. Maks. 2 MB</small>

                                        @error('fotoMhs')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <!-- ================= END FOTO ================= -->


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>NIM</label>
                                            <input type="text" class="form-control" name="nim"
                                                value="{{ $user->nim ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" name="nama_lengkap"
                                                value="{{ $user->nama_lengkap ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $user->email ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>No. Hp</label>
                                            <input type="text" class="form-control" name="no_hp"
                                                value="{{ $user->no_hp ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tempat</label>
                                            <input type="text" class="form-control" name="tempat"
                                                value="{{ $user->datadiri->tempat ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Lahir</label>
                                            <input type="date" class="form-control" name="tgllahir"
                                                value="{{ $user->datadiri->tgllahir ?? '' }}">
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

                                    <div class="col-md-4">
                                        <label>Jenis Kelamin</label>
                                        <select name="jenisKelamin" class="form-control" required>
                                            <option value="">-- Pilih --</option>
                                            <option value="Laki-laki"
                                                {{ $data?->jenisKelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki
                                            </option>
                                            <option value="Perempuan"
                                                {{ $data?->jenisKelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Kelas</label>
                                        <select name="id_kelas" class="form-control" required>
                                            @foreach ($kelas as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ $data?->id_kelas == $k->id ? 'selected' : '' }}>
                                                    {{ $k->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label>Semester</label>
                                        <select name="id_semester" class="form-control" required>
                                            @foreach ($semester as $s)
                                                <option value="{{ $s->id }}"
                                                    {{ $data?->id_semester == $s->id ? 'selected' : '' }}>
                                                    {{ $s->nama_semester }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 mt-3">
                                        <label>Alamat</label>
                                        <textarea class="form-control" name="alamat">{{ $data->alamat ?? '' }}</textarea>
                                    </div>

                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                    </div>
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
        const defaultFoto = "{{ asset('admin/img/profile.jpg') }}";

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
            document.getElementById('previewFoto').src = defaultFoto;
            document.getElementById('fotoMhs').value = "";
        }
    </script>
@endpush
