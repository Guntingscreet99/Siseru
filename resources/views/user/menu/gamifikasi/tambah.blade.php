@extends('bagian.user.rumah.home')
@section('judul', 'User | Tambah Data Ujin')
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
                                <a href="{{ url('user/menu/ujian') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ url('user/ujian/tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Judul</label>
                                                <input type="text" name="judul" id="judul" class="form-control"
                                                    placeholder="Masukkan Judul Modul" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Link Ujian</label>
                                                <input type="text" name="link" id="link" class="form-control"
                                                    placeholder="Masukkan Link Ujian">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Hasil</label>
                                                <input type="text" name="hasil" id="hasil" class="form-control"
                                                    placeholder="Masukkan Hasil Ujian" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">File Ujian</label>
                                                <input type="file" name="fileUjian" id="fileUjian" class="form-control">
                                            </div>
                                        </div>
                                        <input type="hidden" name="judulFileAsli">

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Deskripsi</label>
                                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="10" rows="5">{{ old('deskripsi') }}</textarea>
                                                @error('deskripsi')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Ditampilkan">Ditampilkan</option>
                                                    <option value="Tidak ditampilkan">Tidak Ditampilkan</option>
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
