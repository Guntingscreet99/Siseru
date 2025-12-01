@extends('bagian.user.rumah.home')
@section('judul', 'User | Edit Data Ranking')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="mb-3" style="display: flex; justify-content: space-between">
                            <div class="form-group">
                                <a href="{{ url('user/menu/peringkat') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                            {{-- <div class="form-group" style="display: flex; align-items: center;">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Cari..." style="width: 70%;">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> --}}
                        </div>
                        <form action="{{ url('user/peringkat-edit/' . $peringkat->kdperingkat) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Nama Mahasiswa</label>
                                                <input type="text" name="namaMhs" id="namaMhs" class="form-control"
                                                    value="{{ $peringkat->namaMhs }}" placeholder="Masukkan Nama Mahasiswa"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kelas</label>
                                                <select name="id_kelas" id="id_kelas" class="form-control">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    @foreach ($kelas as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $peringkat->id_kelas == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama_kelas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Semester</label>
                                                <select name="id_semester" id="id_semester" class="form-control">
                                                    <option value="">-- Pilih Semester --</option>
                                                    @foreach ($semester as $sem)
                                                        <option value="{{ $sem->id }}"
                                                            {{ $peringkat->id_semester == $sem->id ? 'selected' : '' }}>
                                                            {{ $sem->nama_semester }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">NIM</label>
                                                <input type="text" name="nim" id="nim" class="form-control"
                                                    value="{{ $peringkat->nim }}" placeholder="Masukkan NIM" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Skor Karya</label>
                                                <input type="number" name="skorKarya" id="skorKarya" class="form-control"
                                                    value="{{ $peringkat->skorKarya }}"
                                                    placeholder="Masukkan Skor Galeri Karya" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Skor Ujian</label>
                                                <input type="number" name="skorUjian" id="skorUjian" class="form-control"
                                                    value="{{ $peringkat->skorUjian }}" placeholder="Masukkan Skor Ujian"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Ranking</label>
                                                <input type="number" name="ranking" id="ranking" class="form-control"
                                                    value="{{ $peringkat->ranking }}" placeholder="Masukkan Ranking"
                                                    required>
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="fileKarya">File Karya</label>
                                                <input type="file" name="fileKarya" id="fileKarya" class="form-control">

                                                @if ($karya->fileKarya)
                                                    <p class="mt-2">
                                                        <li>
                                                            *File saat ini
                                                            <a href="{{ Storage::url($karya->fileKarya) }}"
                                                                target="_blank">
                                                                {{ $karya->judulFileAsli }}
                                                            </a>
                                                        </li>
                                                    </p>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="gunakan_file_lama"
                                                            id="gunakan_file_lama" class="form-check-input" checked>
                                                        <label class="form-check-label" for="gunakan_file_lama">
                                                            Gunakan file lama
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Ditampilkan"
                                                        {{ $peringkat->status == 'Ditampilkan' ? 'selected' : '' }}>
                                                        Ditampilkan
                                                    </option>
                                                    <option value="Tidak Ditampilkan"
                                                        {{ $peringkat->status == 'Tidak Ditampilkan' ? 'selected' : '' }}>
                                                        Tidak
                                                        Ditampilkan
                                                    </option>
                                                </select>
                                            </div>
                                        </div> --}}
                                    </div>
                                </table>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" style="margin-right: 10px">Tutup</button> --}}
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
