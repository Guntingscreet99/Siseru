@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Master Data Modul')
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
                                <a href="{{ url('admin/modul-tambah-tampil') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Modul
                                </a>
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahguru">
                                 <i class="fas fa-plus"></i> Tambah Data Agama
                            </button> --}}
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
                                        <th scope="col">Judul</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Topik</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">File Modul</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="modul-body">
                                    @if ($modul->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center">Data Masih Kosong</td>
                                        </tr>
                                    @else
                                        @foreach ($modul as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ $item->kelas }}</td>
                                                <td>{{ $item->semester }}</td>
                                                <td>{{ $item->topik }}</td>
                                                <td>{{ $item->tahun }}</td>
                                                <td>
                                                    <a href="{{ asset('storage/' . $item->fileModul) }}" target="_blank">
                                                        {{ $item->judulFileAsli }}
                                                    </a>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ url('admin/modul/ubah/' . $item->kdmodul) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Hapus{{ $item->kdmodul }}">
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

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let timer;

            $('#search').on('input', function() {
                clearTimeout(timer);
                let query = $(this).val().trim();

                if (query === "") {
                    $('#modul-body').html(""); // Kosongkan jika tidak ada input
                    return;
                }

                timer = setTimeout(function() {
                    $.ajax({
                        url: "{{ url('admin/modul-cari') }}", // Gunakan URL absolute
                        method: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            console.log("Data ditemukan:", data); // Debugging

                            let rows = "";

                            if (data.length === 0) {
                                rows =
                                    `<tr><td colspan="7" class="text-center">Data tidak ditemukan.</td></tr>`;
                            } else {
                                $.each(data, function(index, item) {
                                    let fileUrl = item.fileModul ?
                                        `{{ asset('storage') }}/${item.fileModul}` :
                                        "#";
                                    let deleteModalId = `deleteModal${item.id}`;

                                    rows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.judul}</td>
                                        <td>${item.kelas}</td>
                                        <td>${item.semester}</td>
                                        <td>${item.topik}</td>
                                        <td>${item.tahun}</td>
                                        <td>
                                            <a href="${fileUrl}" target="_blank">
                                                ${item.judulFileAsli ? item.judulFileAsli : 'Unduh'}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/modul-edit') }}/${item.id}" class="btn btn-warning">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>

                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#${deleteModalId}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>

                                            <div class="modal fade" id="${deleteModalId}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteLabel${item.id}" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteLabel${item.id}">Hapus Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ url('admin/modul-hapus') }}/${item.id}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="modal-body">
                                                                <center>
                                                                    <h5 class="mt-2 mb-3">Apakah Anda ingin menghapus data ini?</h5>
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="bx bx-check"></i>
                                                                        Hapus
                                                                    </button>
                                                                </center>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>`;
                                });
                            }

                            $('#modul-body').html(rows);
                        },
                        error: function(xhr) {
                            console.error("Gagal mengambil data!", xhr);
                        }
                    });
                }, 500);
            });
        });
    </script>
@endpush
