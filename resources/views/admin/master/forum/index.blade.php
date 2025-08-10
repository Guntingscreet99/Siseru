@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Master Data Forum')
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
                                <a href="{{ url('admin/forum/tampil') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data Forum
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
                                        <th scope="col">Akun</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Topik</th>
                                        <th scope="col">Tahun</th>
                                        <th scope="col">File Forum</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="forum-body">
                                    @if ($forum->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center">Data Masih Kosong</td>
                                        </tr>
                                    @else
                                        @foreach ($forum as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->akun }}</td>
                                                <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                                <td>{{ $item->semester->nama_semester ?? '-' }}</td>
                                                <td>{{ $item->topik }}</td>
                                                <td>{{ $item->tahun }}</td>
                                                {{-- <td>
                                                    <a href="{{ $item->link }}" target="_blank">
                                                        {{ $item->link }}
                                                    </a>
                                                </td> --}}
                                                <td>
                                                    @if ($item->fileForum)
                                                        @php
                                                            $ext = pathinfo($item->fileForum, PATHINFO_EXTENSION);
                                                            $fileUrl = Storage::url($item->fileForum);
                                                        @endphp

                                                        @if (in_array($ext, ['mp4', 'mkv', 'avi']))
                                                            <video width="250" controls>
                                                                <source src="{{ $fileUrl }}"
                                                                    type="video/{{ $ext }}">
                                                                Browser Anda tidak mendukung tag video.
                                                            </video>
                                                        @elseif (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                            <img src="{{ $fileUrl }}" alt="Gambar" width="250">
                                                        @elseif (in_array($ext, ['pdf']))
                                                            <embed src="{{ $fileUrl }}" type="application/pdf"
                                                                width="100%" height="250px" />
                                                        @elseif (in_array($ext, ['doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt']))
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-sm btn-success">
                                                                <i class="fas fa-file-alt"></i> Lihat Dokumen
                                                            </a>
                                                        @else
                                                            <a href="{{ $fileUrl }}" target="_blank"
                                                                class="btn btn-sm btn-info">
                                                                <i class="fas fa-download"></i> Unduh File
                                                            </a>
                                                        @endif
                                                    @else
                                                        <p>Tidak ada file</p>
                                                    @endif
                                                </td>

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ url('admin/forum/ubah/' . $item->kdforum) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Hapus{{ $item->kdforum }}">
                                                        <i class="fas fa-trash"> </i>Hapus
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

    @include('admin.master.forum.hapus')

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
                    $('#forum-body').html(""); // Kosongkan jika tidak ada input
                    return;
                }

                timer = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('admin.forum.cari') }}",
                        method: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            let rows = "";

                            if (data.length === 0) {
                                rows =
                                    `<tr><td colspan="7" class="text-center">Data tidak ditemukan.</td></tr>`;
                            } else {
                                $.each(data, function(index, item) {
                                    rows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.akun}</td>
                                        <td>${item.kelas}</td>
                                        <td>${item.semester}</td>
                                        <td>${item.topik}</td>
                                        <td>${item.tahun}</td>
                                        <td>
                                            <!-- Button Edit -->
                                            <a href="admin/forum/ubah/${item.kdforum}" class="btn btn-warning">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>

                                            <!-- Button Hapus -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Hapus${item.kdforum}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>

                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="Hapus${item.kdforum}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Data Forum</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="admin/forum-hapus/${item.kdforum}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="modal-body">
                                                                <center>
                                                                    <h5 class="mt-2 mb-3">Apakah anda ingin menghapus data ini?</h5>
                                                                    <button type="submit" class="btn btn-danger ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Hapus</span>
                                                                    </button>
                                                                </center>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                                });
                            }

                            $('#forum-body').html(rows);
                        },
                        error: function() {
                            console.log("Gagal mengambil data!");
                        }
                    });
                }, 500);
            });
        });
    </script>
@endpush
