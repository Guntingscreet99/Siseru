@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Tambah Data Karya')
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
                                <a href="{{ url('admin/master/datakarya') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ url('admin/karya/tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Nama Karya</label>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    placeholder="Masukkan Nama Karya" required>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">File Karya</label>
                                                    <input type="file" name="fileKarya" id="fileKarya"
                                                        class="form-control">
                                                    <small class="text-muted">Jenis file yang diperbolehkan: JPG, PNG, MP4,
                                                        MKV, AVI, PDF, DOCX, TXT</small>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Deskripsi Karya</label>
                                                    <textarea name="deskripsi" id="deskripsi" class="form-control" cols="10" rows="5"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="form-group">
                                                    <label for="">Status Karya</label>
                                                    <select name="status" id="status" class="form-control">
                                                        <option value="">-- Pilih Status --</option>
                                                        <option value="Ditampilkan">Ditampilkan</option>
                                                        <option value="Tidak Ditampilkan">Tidak Ditampilkan</option>
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
