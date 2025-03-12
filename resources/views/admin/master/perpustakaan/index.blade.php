@extends('bagian.admin.rumah.home')
@section('judul', 'Master Data Perpustakaan')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="Perpustakaan">
                <div class="judul">
                    <h1>Perpustakaan</h1>
                    {{-- <h2>Bukanlah Akhir Dari Segalanya</h2> --}}
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="mb-3" style="display: flex; justify-content: space-between">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tambahperpustakaan">
                                    <i class="fas fa-plus"></i> Tambah Data Perpustakaan
                                </button>
                            </div>
                            <div class="form-group" style="display: flex; align-items: center;">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Cari..." style="width: 70%;">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive table-striped table-bordered text-center"
                                style="white-space: nowrap; overflow-x: auto; width: 100%">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Judul Buku</th>
                                        <th scope="col">kategori Buku</th>
                                        <th scope="col">Judul Modul</th>
                                        <th scope="col">Kategori Modul</th>
                                        <th scope="col">Judul Artikel</th>
                                        <th scope="col">Kategori Artikel</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($perpustakaan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->judulbuku }}</td>
                                            <td>{{ $item->kategoribuku }}</td>
                                            <td>{{ $item->judulmodul }}</td>
                                            <td>{{ $item->kategorimodul }}</td>
                                            <td>{{ $item->judulartikel }}</td>
                                            <td>{{ $item->kategoriartikel }}</td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#Edit{{ $item->id }}">
                                                    <i class="fas fa-pen"> Edit</i>
                                                </button>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#Hapus{{ $item->id }}">
                                                    <i class="fas fa-trash"> Hapus</i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.master.perpustakaan.tambah')
    @include('admin.master.perpustakaan.edit')
    @include('admin.master.perpustakaan.hapus')

@endsection

{{-- @push('css')

@endpush

@push('js')

@endpush --}}
