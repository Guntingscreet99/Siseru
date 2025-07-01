@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Master Data Nama Mahasiswa')
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#tambahkelas">
                                    <i class="fas fa-plus"></i> Tambah User
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive table-striped table-bordered text-center"
                                style="white-space: nowrap">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama</th>
                                        <th scope="col">Nim</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="modul-body">
                                    @if ($mahasiswa->isEmpty())
                                        <tr>
                                            <td colspan="4" class="text-center">Data Masih Kosong</td>
                                        </tr>
                                    @else
                                        @foreach ($mahasiswa as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_mahasiswa }}</td>
                                                <td>{{ $item->nim }}</td>
                                                <td>{{ $item->jenisKelamin }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                        data-bs-target="#edit{{ $item->id }}">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#hapus{{ $item->id }}">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.master.user.tambah')
    @include('admin.master.user.edit')
    @include('admin.master.user.hapus')

@endsection
