@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Edit Data Ujian')
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
                                <a href="{{ url('admin/master/dataujian') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ url('admin/ujian-edit/' . $ujian->kdujian) }}" method="POST"
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
                                                    value="{{ $ujian->judul }}" placeholder="Masukkan Judul Ujian" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Link Ujian</label>
                                                <input type="text" name="link" id="link" class="form-control"
                                                    value="{{ $ujian->link }}" placeholder="Masukkan Link Ujian">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">hasil</label>
                                                <input type="text" name="hasil" id="hasil" class="form-control"
                                                    value="{{ $ujian->hasil }}" placeholder="Masukkan Hasil" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">File Ujian</label>
                                                <input type="file" name="fileUjian" id="fileUjian" class="form-control">

                                                @if ($ujian->fileUjian)
                                                    <p class="mt-2">
                                                        <li>
                                                            *File saat ini:
                                                            <a href="{{ Storage::url($ujian->fileUjian) }}" target="_blank">
                                                                {{ $ujian->judulFileAsli }}
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
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Deskripsi Ujian</label>
                                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="10" rows="5">{{ old('deskripsi', $ujian->deskripsi) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Ditampilkan"
                                                        {{ $ujian->status == 'Ditampilkan' ? 'selected' : '' }}>
                                                        Ditampilkan
                                                    </option>
                                                    <option value="Tidak Ditampilkan"
                                                        {{ $ujian->status == 'Tidak Ditampilkan' ? 'selected' : '' }}>
                                                        Tidak Ditampilkan
                                                    </option>
                                                </select>
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
