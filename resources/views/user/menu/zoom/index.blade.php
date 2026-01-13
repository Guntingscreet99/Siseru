@extends('bagian.user.rumah.home')
@section('judul', 'User | Data Ujian')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>

                <div class="card">
                    <div class="card-body">

                        {{-- SEARCH --}}
                        <div class="mb-3 d-flex justify-content-end">
                            <div class="input-group" style="max-width: 400px;">
                                <input type="text" id="search" class="form-control"
                                    placeholder="Cari ujian / kelas / semester">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Ujian</th>
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>Mulai</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th>Link</th>
                                    </tr>
                                </thead>
                                <tbody id="ujian-body">
                                    @forelse ($ujians as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->ujian }}</td>
                                            <td>{{ $item->kelas }}</td>
                                            <td>{{ $item->semester }}</td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($item->waktu_mulai)->translatedFormat('d F Y, H:i') }}
                                            </td>
                                            <td>{{ $item->durasi_menit }} menit</td>
                                            <td>
                                                @if (now()->lt($item->waktu_mulai))
                                                    <span class="badge bg-secondary">Belum Dimulai</span>
                                                @elseif (now()->between($item->waktu_mulai, $item->waktu_selesai))
                                                    <span class="badge bg-success">Sedang Berlangsung</span>
                                                @else
                                                    <span class="badge bg-danger">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->link)
                                                    <a href="{{ $item->link }}" target="_blank"
                                                        class="btn btn-sm btn-info">
                                                        Lihat
                                                    </a>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8">Data ujian belum tersedia</td>
                                        </tr>
                                    @endforelse
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
                let query = $(this).val();

                timer = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('user.ujian.cari') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {

                            let rows = '';

                            if (data.length === 0) {
                                rows =
                                    `<tr><td colspan="8">Data tidak ditemukan</td></tr>`;
                            } else {
                                $.each(data, function(index, item) {

                                    let statusBadge = '';
                                    let now = new Date();

                                    if (now < new Date(item.waktu_mulai)) {
                                        statusBadge =
                                            '<span class="badge bg-secondary">Belum Dimulai</span>';
                                    } else if (now >= new Date(item
                                        .waktu_mulai) && now <= new Date(item
                                            .waktu_selesai)) {
                                        statusBadge =
                                            '<span class="badge bg-success">Sedang Berlangsung</span>';
                                    } else {
                                        statusBadge =
                                            '<span class="badge bg-danger">Selesai</span>';
                                    }

                                    rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.ujian}</td>
                                    <td>${item.kelas}</td>
                                    <td>${item.semester}</td>
                                    <td>${item.waktu_mulai_format}</td>
                                    <td>${item.durasi_menit} menit</td>
                                    <td>${statusBadge}</td>
                                    <td>
                                        ${item.link
                                            ? `<a href="${item.link}" target="_blank" class="btn btn-sm btn-info">Lihat</a>`
                                            : `<span class="text-muted">-</span>`}
                                    </td>
                                </tr>`;
                                });
                            }

                            $('#ujian-body').html(rows);
                        }
                    });
                }, 400);
            });
        });
    </script>
@endpush
