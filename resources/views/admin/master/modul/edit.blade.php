@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Edit Data Modul')
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
                                <a href="{{ url('admin/master-modul') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ url('admin/modul-edit/' . $modul->kdmodul) }}" method="POST"
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
                                                    value="{{ $modul->judul }}" placeholder="Masukkan Judul Modul" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kelas</label>
                                                <select name="kelas" id="kelas" class="form-control">
                                                    <option value="{{ $modul->kelas }}">-- Pilih Kelas --</option>
                                                    <option value="Kelas 1"
                                                        {{ $modul->kelas == 'Kelas 1' ? 'selected' : '' }}>Kelas 1
                                                    </option>
                                                    <option value="Kelas 2"
                                                        {{ $modul->kelas == 'Kelas 2' ? 'selected' : '' }}>Kelas 2
                                                    </option>
                                                    <option value="Kelas 3"
                                                        {{ $modul->kelas == 'Kelas 3' ? 'selected' : '' }}>Kelas 3
                                                    </option>
                                                    <option value="Kelas 4"
                                                        {{ $modul->kelas == 'Kelas 4' ? 'selected' : '' }}>Kelas 4
                                                    </option>
                                                    <option value="Kelas 5"
                                                        {{ $modul->kelas == 'Kelas 5' ? 'selected' : '' }}>Kelas 5
                                                    </option>
                                                    <option value="Kelas 6"
                                                        {{ $modul->kelas == 'Kelas 6' ? 'selected' : '' }}>Kelas 6
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Semester</label>
                                                <select name="semester" id="semester" class="form-control">
                                                    <option value="">-- Pilih Semester --</option>
                                                    <option value="Ganjil"
                                                        {{ $modul->semester == 'Ganjil' ? 'selected' : '' }}>Ganjil
                                                    </option>
                                                    <option value="Genap"
                                                        {{ $modul->semester == 'Genap' ? 'selected' : '' }}>Genap</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tahun</label>
                                                <input type="text" name="tahun" id="tahun" class="form-control"
                                                    value="{{ $modul->tahun }}" placeholder="Masukkan Tahun">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">File Modul</label>
                                                <input type="file" name="fileModul" id="fileModul" class="form-control">

                                                @if ($modul->fileModul)
                                                    <p class="mt-2">
                                                        <li>
                                                            *File saat ini:
                                                            <a href="{{ Storage::url($modul->fileModul) }}"
                                                                target="_blank">
                                                                {{ $modul->judulFileAsli }}
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
                                                        {{ $modul->status == 'Ditampilkan' ? 'selected' : '' }}>Ditampilkan
                                                    </option>
                                                    <option value="Tidak Ditampilkan"
                                                        {{ $modul->status == 'Tidak Ditampilkan' ? 'selected' : '' }}>Tidak
                                                        Ditampilkan
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Topik</label>
                                                <textarea name="topik" id="topik" class="form-control" cols="10" rows="5">{{ $modul->topik }}</textarea>
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
