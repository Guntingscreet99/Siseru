@extends('bagian.user.rumah.home')
@section('judul', 'User | Tambah Data Perpustakaan')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-dark text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Data Perpustakaan Baru
                    </h3>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="mb-3" style="display: flex; justify-content: space-between">
                            <div class="form-group">
                                <a href="{{ url('user/menu/perpus') }}" class="btn btn-primary">
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
                        <form action="{{ url('user/perpus/tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Judul</label>
                                                <input type="text" name="judul" id="judul" class="form-control"
                                                    placeholder="Masukkan Judul" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kategori</label>
                                                <select name="kategori" id="kategori" class="form-control">
                                                    <option value="">-- Pilih Kategori --</option>
                                                    <option value="Buku">Buku</option>
                                                    <option value="Jurnal">Jurnal</option>
                                                    <option value="Artikel">Artikel</option>
                                                    {{-- <option value="Modul Pembelajaran">Modul Pembelajaran</option> --}}
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tahun</label>
                                                <input type="text" name="tahun" id="tahun" class="form-control"
                                                    placeholder="Masukkan Tahun Terbit" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tema</label>
                                                <input type="text" name="topik" id="topik" class="form-control"
                                                    placeholder="Masukkan Tema" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">File Perpustakaan</label>
                                                <input type="file" name="filePerpus" id="filePerpus"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <input type="hidden" name="judulFileAsli">
                                        {{-- <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status File</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Ditampilkan">Ditampilkan</option>
                                                    <option value="Tidak ditampilkan">Tidak Ditampilkan</option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-6 mb-4">
                                            <label class="form-label fw-bold text-primary">
                                                <i class="fas fa-image me-2"></i>Cover Buku <small
                                                    class="text-muted">(Opsional, rekomendasi 1:1)</small>
                                            </label>
                                            <input type="file" name="cover" class="form-control form-control-lg"
                                                accept="image/*">
                                            <div class="form-text">Format: JPG, PNG, WebP (max 2MB)</div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Deskripsi</label>
                                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="10" rows="5"></textarea>
                                            </div>
                                        </div>

                                    </div>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                                    <i class="fas fa-save me-2"></i> Simpan Perpustakaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
