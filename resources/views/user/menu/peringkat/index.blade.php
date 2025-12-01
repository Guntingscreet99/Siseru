@extends('bagian.user.rumah.home')
@section('judul', 'User | Peringkat')
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
                                <a href="{{ url('user/peringkat/tampil') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data Peringkat
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
                                        <th scope="col">Nama Mahasiswa</th>
                                        <th scope="col">Nim</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Skor Galeri Karya</th>
                                        <th scope="col">Skor Ujian</th>
                                        <th scope="col">Ranking</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="peringkat-body">
                                    @if ($peringkat->isEmpty())
                                        <tr>
                                            <td colspan="10" class="text-center">Data Masih Kosong</td>
                                        </tr>
                                    @else
                                        @foreach ($peringkat as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->namaMhs }}</td>
                                                <td>{{ $item->nim }}</td>
                                                <td>{{ $item->kelas->nama_kelas }}</td>
                                                <td>{{ $item->semester->nama_semester }}</td>
                                                <td>{{ $item->skorKarya }}</td>
                                                <td>{{ $item->skorUjian }}</td>
                                                <td>{{ $item->ranking }}</td>

                                                {{-- <td>
                                                    <a href="{{ asset('storage/' . $item->fileModul) }}" target="_blank">
                                                        {{ $item->judulFileAsli ?? basename($item->fileModul) }}
                                                    </a>
                                                </td> --}}

                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ url('user/peringkat/ubah/' . $item->kdperingkat) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Hapus{{ $item->kdperingkat }}">
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

    @include('user.menu.peringkat.hapus')

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
                $('#peringkat-body').html(""); // Kosongkan jika tidak ada input
                return;
            }

            timer = setTimeout(function() {
                $.ajax({
                            url: "{{ url('user/peringkat/cari') }}", // Gunakan URL absolute
                            method: "GET",
                            data: {
                                query: query
                            },
                            success: function(data) {
                                console.log("Data ditemukan:", data); // Debugging

                                let rows = "";

                                if (data.length === 0) {
                                    rows =
                                        `<tr><td colspan="9" class="text-center">Data tidak ditemukan.</td></tr>`;
                                } else {
                                    // $.each(data, function(index, item) {
                                    //     let fileUrl = item.fileModul ?
                                    //         `{{ asset('storage') }}/${item.fileModul}` :
                                    //         "#";
                                    //     let deleteModalId = `deleteModal${item.id}`;

                                    rows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.namaMhs}</td>
                                        <td>${item.nim}</td>
                                        <td>${item.kelas}</td>
                                        <td>${item.semester}</td>
                                        <td>${item.skorKarya}</td>
                                        <td>${item.skorUjian}</td>
                                        <td>${item.ranking}</td>
                                        <td>
                                            <a href="{{ url('user/peringkat-edit/') }}/${item.id}" class="btn btn-warning">
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
                                                        <form action="{{ url('user/peringkat-hapus/') }}/${item.id}" method="POST">
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

                        $('#peringkat-body').html(rows);
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
