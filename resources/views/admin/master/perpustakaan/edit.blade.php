@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Edit Data Perpustakaan')
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
                                <a href="{{ url('admin/master/dataperpus') }}" class="btn btn-primary">
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
                        <form action="{{ url('admin/perpus-edit/' . $perpus->kdperpus) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Judul</label>
                                                <input type="text" name="judul" id="judul" class="form-control"
                                                    value="{{ $perpus->judul }}" placeholder="Masukkan Akun" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kategori</label>
                                                <select name="kategori" id="kategori" class="form-control">
                                                    <option value="{{ $perpus->kategori }}">-- Pilih Kategori --</option>
                                                    <option value="Buku"
                                                        {{ $perpus->kategori == 'Buku' ? 'selected' : '' }}>Buku
                                                    </option>
                                                    <option value="Jurnal"
                                                        {{ $perpus->kategori == 'Jurnal' ? 'selected' : '' }}>Jurnal
                                                    </option>
                                                    <option value="Artikel"
                                                        {{ $perpus->kategori == 'Artikel' ? 'selected' : '' }}>Artikel
                                                    </option>
                                                    <option value="Modul Pembelajaran"
                                                        {{ $perpus->kategori == 'Modul Pembelajaran' ? 'selected' : '' }}>
                                                        Modul Pembelajaran
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tahun</label>
                                                <input type="text" name="tahun" id="tahun" class="form-control"
                                                    value="{{ $perpus->tahun }}" placeholder="Masukkan Tahun Terbit">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tema</label>
                                                <input type="text" name="topik" id="topik" class="form-control"
                                                    value="{{ $perpus->topik }}" placeholder="Masukkan Tema">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">File Perpustakaan</label>
                                                <input type="file" name="filePerpus" id="filePerpus"
                                                    class="form-control">

                                                @if ($perpus->filePerpus)
                                                    <p class="mt-2">
                                                        <li>
                                                            *File saat ini:
                                                            <a href="{{ Storage::url($perpus->filePerpus) }}"
                                                                target="_blank">
                                                                {{ $perpus->judulFileAsli }}
                                                            </a>
                                                        </li>
                                                    </p>

                                                    <input type="checkbox" name="gunakan_file_lama" id="gunakan_file_lama"
                                                        class="form-check-input" checked>
                                                    <label class="form-check-label" for="gunakan_file_lama">Gunakan file
                                                        lama</label>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Ditampilkan"
                                                        {{ $perpus->status == 'Ditampilkan' ? 'selected' : '' }}>
                                                        Ditampilkan
                                                    </option>
                                                    <option value="Tidak Ditampilkan"
                                                        {{ $perpus->status == 'Tidak Ditampilkan' ? 'selected' : '' }}>
                                                        Tidak Ditampilkan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Deskripsi</label>
                                                <input type="text" name="deskripsi" id="deskripsi" class="form-control"
                                                    value="{{ $perpus->deskripsi }}" placeholder="Masukkan Deskripsi"
                                                    required>
                                            </div>
                                        </div>
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
