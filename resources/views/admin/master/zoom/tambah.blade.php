@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Tambah Data Zoom')
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
                                <a href="{{ url('admin/master/datazoom') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ url('admin/zoom/tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kelas</label>
                                                <select name="kelas" id="kelas" class="form-control">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    <option value="Kelaas A">Kelaas A</option>
                                                    <option value="Kelas B">Kelas B</option>
                                                    <option value="Kelas C">Kelas C</option>
                                                    <option value="Kelas D">Kelas D</option>
                                                    <option value="Kelas E">Kelas E</option>
                                                    <option value="Kelas F">Kelas F</option>
                                                    <option value="Kelas H">Kelas H</option>
                                                    <option value="Kelas I">Kelas I</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Link Zoom</label>
                                                <input type="text" name="linkZoom" id="linkZoom" class="form-control"
                                                    placeholder="Masukkan Link Zoom">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Link Webinar</label>
                                                <input type="text" name="linkWebinar" id="linkWebinar"
                                                    class="form-control" placeholder="Masukkan Link Webinar">
                                            </div>
                                        </div>
                                        <input type="hidden" name="judulFileAsli">
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
