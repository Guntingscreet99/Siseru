@extends('bagian.user.rumah.home')
@section('judul', 'Ujian & Evaluasi')
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
                                <button class="btn btn-info">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center align-middle">
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
                                            <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                            <td>{{ $item->semester->nama_semester ?? '-' }}</td>
                                            <td>{{ $item->waktu_mulai_format }}</td>
                                            <td>{{ $item->durasi_menit ?? '-' }} menit</td>
                                            <td>
                                                @if ($item->waktu_mulai && now()->lt($item->waktu_mulai))
                                                    <span class="badge bg-secondary">Belum Dimulai</span>
                                                @elseif ($item->waktu_selesai && now()->between($item->waktu_mulai, $item->waktu_selesai))
                                                    <span class="badge bg-success">Sedang Berlangsung</span>
                                                @else
                                                    <span class="badge bg-danger">Selesai</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->link && $item->waktu_selesai && now()->between($item->waktu_mulai, $item->waktu_selesai))
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

            $('#search').on('keyup', function() {
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
                                $.each(data, function(i, item) {

                                    let status = 'Selesai';
                                    let now = new Date();

                                    if (item.waktu_mulai && now < new Date(item
                                            .waktu_mulai)) {
                                        status = 'Belum Dimulai';
                                    } else if (item.waktu_selesai && now <=
                                        new Date(item.waktu_selesai)) {
                                        status = 'Sedang Berlangsung';
                                    }

                                    rows += `
                            <tr>
                                <td>${i + 1}</td>
                                <td>${item.ujian}</td>
                                <td>${item.kelas?.nama_kelas ?? '-'}</td>
                                <td>${item.semester?.nama_semester ?? '-'}</td>
                                <td>${item.waktu_mulai_format}</td>
                                <td>${item.durasi_menit ?? '-'} menit</td>
                                <td>${status}</td>
                                <td>
                                    ${item.link && status === 'Sedang Berlangsung'
                                        ? `<a href="${item.link}" target="_blank" class="btn btn-sm btn-info">Lihat</a>`
                                        : '-'}
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
