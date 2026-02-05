@extends('bagian.user.rumah.home')
@section('judul', 'Kelas Interaktif')

@section('isi')
    <div class="container">
        <div class="page-inner">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">@yield('judul')</h4>
                </div>

                <div class="card-body">

                    {{-- SEARCH --}}
                    <div class="mb-3 d-flex justify-content-end">
                        <input type="text" id="search" class="form-control w-25" placeholder="Cari kelas / link zoom">
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped text-center align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Kelas</th>
                                    <th>Link Zoom</th>
                                    <th>Link Webinar</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody id="zoom-body">
                                @forelse ($zooms as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                        <td>
                                            @if ($item->linkZoom)
                                                <a href="{{ $item->linkZoom }}" target="_blank" class="btn btn-sm btn-info">
                                                    Buka Zoom
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->linkWebinar)
                                                <a href="{{ $item->linkWebinar }}" target="_blank"
                                                    class="btn btn-sm btn-success">
                                                    Buka Webinar
                                                </a>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $item->status }}</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">Data Zoom belum tersedia</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
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
                        url: "{{ route('user.zoom.cari') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            let rows = '';

                            if (data.length === 0) {
                                rows =
                                    `<tr><td colspan="5">Data tidak ditemukan</td></tr>`;
                            } else {
                                $.each(data, function(index, item) {
                                    rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.kelas ? item.kelas.nama_kelas : '-'}</td>
                                    <td>
                                        ${item.linkZoom
                                            ? `<a href="${item.linkZoom}" target="_blank" class="btn btn-sm btn-info">Buka Zoom</a>`
                                            : `<span class="text-muted">-</span>`}
                                    </td>
                                    <td>
                                        ${item.linkWebinar
                                            ? `<a href="${item.linkWebinar}" target="_blank" class="btn btn-sm btn-success">Buka Webinar</a>`
                                            : `<span class="text-muted">-</span>`}
                                    </td>
                                    <td>
                                        <span class="badge bg-success">${item.status}</span>
                                    </td>
                                </tr>`;
                                });
                            }

                            $('#zoom-body').html(rows);
                        }
                    });
                }, 400);
            });
        });
    </script>
@endpush
