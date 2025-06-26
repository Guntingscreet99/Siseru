@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Master Data Semester')
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
                                    <i class="fas fa-plus"></i> Tambah Kelas
                                </button>
                            </div>
                        </div>

                        <div class="filter">
                            <form method="GET" action="{{ route('admin.kelas.index') }}"
                                class="d-flex justify-content-between mb-3">
                                <div>
                                    <select name="entries" class="form-select" onchange="this.form.submit()">
                                        @foreach ([10, 25, 50, 100] as $jumlah)
                                            <option value="{{ $jumlah }}"
                                                {{ request('entries', 10) == $jumlah ? 'selected' : '' }}>
                                                Tampilkan {{ $jumlah }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="d-flex">
                                    <input type="text" name="search" value="{{ request('search') }}"
                                        class="form-control me-2" placeholder="Cari nama kelas...">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-responsive table-striped table-bordered text-center"
                                style="white-space: nowrap">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kelas</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="modul-body">
                                    @if ($kelas->isEmpty())
                                        <tr>
                                            <td colspan="3" class="text-center">Data Masih Kosong</td>
                                        </tr>
                                    @else
                                        @foreach ($kelas as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->nama_kelas }}</td>
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

    @include('admin.master.kelas.tambah')
    @include('admin.master.kelas.edit')
    @include('admin.master.kelas.hapus')

@endsection
