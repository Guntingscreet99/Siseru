@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Tambah Data perpustakaan')
@section('isi')

    <!--Modal Tambah -->
    <div class="modal fade" id="tambahhasil" data-bs-backdrop="static" data-bs-keyboard="false"tabindex="-1"
        aria-labelledby="staticBackdropLabel"aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="tambahperpustakaan">Tambah Data Perpustakaan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/perpustakaan/tambah') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Judul Buku</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Judul Buku"
                                        name="judulbuku" id="judulbuku" required></input>
                                </div>
                                {{-- <div class="form-group">
                                <label for="">Kelas Siswa</label>
                                <select name="kelas" id="kelas"class="form-control">
                                    <option value="">--Pilih Kelas Anak--</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                </select>
                            </div> --}}
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Kategori Buku</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Kategori Buku"
                                        name="kategoribuku" id="kategoribuku" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Judul Modul</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Judul Modul"
                                        name="judulmodul" id="judulmodul" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Kategori Modul</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Kategori Modul"
                                        name="kategorimodul" id="kategorimodul" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Judul Artikel</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Judul Artikel"
                                        name="judulartikel" id="judulartikel" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Kategori Artikel</label>
                                    {{-- <textarea name="hasil" id="hasil" cols="20" rows="5" class="form-control"></textarea> --}}
                                    <input type="text" class="form-control" placeholder="Masukkan Kategori Artikel"
                                        name="kategoriartikel" id="kategoriartikel" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
