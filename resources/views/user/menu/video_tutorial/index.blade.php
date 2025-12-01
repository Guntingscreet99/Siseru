@extends('bagian.user.rumah.home')
@section('judul', 'User | Video')
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
                                <a href="{{ url('user/video/tampil') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Video
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
                                        <th scope="col">Judul Video</th>
                                        <th scope="col">Deskripsi Video</th>
                                        <th scope="col">Link Video</th>
                                        <th scope="col">File Video</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="video-body">
                                    @if ($video->isEmpty())
                                        <tr>
                                            <td colspan="7" class="text-center">Data Masih Kosong</td>
                                        </tr>
                                    @else
                                        @foreach ($video as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->judul }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                <td>
                                                    <a href="{{ $item->link }}" target="_blank">
                                                        {{ $item->link }}
                                                    </a>
                                                </td>
                                                <td>
                                                    @if ($item->fileVideo)
                                                        <video width="250" controls>
                                                            <source src="{{ Storage::url($item->fileVideo) }}"
                                                                type="video/mp4">
                                                            Browser Anda tidak mendukung tag video.
                                                        </video>
                                                    @else
                                                        <p>Tidak ada Video</p>
                                                    @endif
                                                </td>
                                                {{-- <td>
                                                    <form method="POST" action="{{ url('admin/video/update-status') }}">
                                                        @csrf
                                                        <input type="hidden" name="kdvideo" value="{{ $item->kdvideo }}">
                                                        <div class="status-wrapper">
                                                            <input type="checkbox" name="status"
                                                                id="status_{{ $item->kdvideo }}" value="Ditampilkan"
                                                                onchange="this.form.submit()"
                                                                {{ $item->status === 'Ditampilkan' ? 'checked' : '' }}>
                                                            <label for="status_{{ $item->kdvideo }}"
                                                                class="status-button"></label>
                                                            <div class="status-text">
                                                                <span>{{ $item->status }}</span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td> --}}
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ url('user/video/ubah/' . $item->kdvideo) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Hapus{{ $item->kdvideo }}">
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

    @include('user.menu.video_tutorial.hapus')

@endsection

@push('css')
    <style>
        .status-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Hide the default checkbox */
        .status-wrapper input[type="checkbox"] {
            display: none;
        }

        /* Custom switch style */
        .status-button {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
            background-color: #ccc;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .status-button::after {
            content: "";
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        /* Checked state */
        .status-wrapper input[type="checkbox"]:checked+.status-button {
            background-color: #3314fe;
        }

        .status-wrapper input[type="checkbox"]:checked+.status-button::after {
            transform: translateX(24px);
        }

        .status-text span {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            let timer;

            $('#search').on('input', function() {
                clearTimeout(timer);
                let query = $(this).val().trim();

                if (query === "") {
                    $('#video-body').html(""); // Kosongkan jika tidak ada input
                    return;
                }

                timer = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('user.video.cari') }}",
                        method: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            let rows = "";

                            if (data.length === 0) {
                                rows =
                                    `<tr><td colspan="5" class="text-center">Data tidak ditemukan.</td></tr>`;
                            } else {
                                $.each(data, function(index, item) {
                                    rows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.judul}</td>
                                        <td>${item.deskripsi}</td>
                                        <td>${item.link}</td>

                                        <td>
                                            <!-- Button Edit -->
                                            <a href="{{ url('user/video-edit/') }}/${item.kdvideo}" class="btn btn-warning">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>

                                            <!-- Button Hapus -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Hapus${item.kdvideo}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>

                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="Hapus${item.kdvideo}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Data Video</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="{{ url('user/video-hapus') }}/${item.id}" method="POST">
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

                            $('#video-body').html(rows);
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
