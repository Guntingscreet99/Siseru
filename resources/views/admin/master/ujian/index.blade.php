@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Master Data Ujian')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>

                <div class="card">
                    <div class="card-body">

                        {{-- Tombol Tambah & Search --}}
                        <div class="mb-3 d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.ujian.tampil') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Tambah Data Ujian
                            </a>


                            <div class="input-group" style="max-width: 400px;">
                                <input type="text" id="search" class="form-control"
                                    placeholder="Cari ujian / kelas / semester">
                                <button class="btn btn-info" type="button">
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
                                        <th>Link</th>
                                        <th>Waktu Mulai</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody id="ujian-body">
                                    @forelse ($ujians as $ujian)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration + ($ujians->currentPage() - 1) * $ujians->perPage() }}
                                            </td>
                                            <td>{{ $ujian->ujian }}</td>
                                            <td>{{ $ujian->kelas->nama_kelas }}</td>
                                            <td>{{ $ujian->semester->nama_semester }}</td>
                                            <td>
                                                @if ($ujian->link && $ujian->isAktif())
                                                    <a href="{{ $ujian->link }}" target="_blank"
                                                        class="text-success fw-bold">
                                                        Lihat
                                                    </a>
                                                @elseif ($ujian->link && !$ujian->isAktif())
                                                    <span class="text-danger fst-italic">
                                                        Waktu Habis
                                                    </span>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td>
                                                {{ optional($ujian->waktu_mulai)->format('d/m/Y H:i') ?? '-' }}
                                            </td>

                                            <td>
                                                <span class="badge {{ $ujian->isAktif() ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ $ujian->durasi_menit ?? '-' }} menit
                                                </span>
                                            </td>
                                            <td>
                                                <form action="{{ url('admin/ujian/update-status') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="kdujian" value="{{ $ujian->id }}">
                                                    <div class="form-check form-switch d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" name="status"
                                                            onchange="this.form.submit()"
                                                            {{ $ujian->status === 'Ditampilkan' ? 'checked' : '' }}>
                                                    </div>
                                                    <small>{{ $ujian->status }}</small>
                                                </form>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.ujian.edit-tampil', $ujian) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-pen"></i> Edit
                                                </a>

                                                <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#hapusModal{{ $ujian->id }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9">Data Masih Kosong</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination (Hanya tampil saat tidak search) --}}
                        <div class="d-flex justify-content-center mt-3" id="pagination">
                            {{ $ujians->links() }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL HAPUS --}}
    @foreach ($ujians as $ujian)
        <div class="modal fade" id="hapusModal{{ $ujian->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        Hapus ujian <strong>{{ $ujian->ujian }}</strong>?
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('admin.ujian.hapus', $ujian) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Hapus</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

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
                        url: "{{ route('admin.ujian.cari') }}",
                        type: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {

                            let rows = '';

                            if (data.length === 0) {
                                rows =
                                    `<tr><td colspan="9">Data tidak ditemukan</td></tr>`;
                            } else {
                                $.each(data, function(index, item) {
                                    rows += `
                                <tr>
                                    <td>${index + 1}</td>
                                    <td>${item.ujian}</td>
                                    <td>${item.kelas}</td>
                                    <td>${item.semester}</td>
                                    <td>
                                        ${item.link
                                            ? `<a href="${item.link}" target="_blank">Lihat</a>`
                                            : '-'}
                                    </td>
                                    <td>
                                        ${item.waktu_mulai
                                            ? new Date(item.waktu_mulai).toLocaleString('id-ID')
                                            : '-'}
                                    </td>
                                    <td>
                                        <span class="badge bg-info">
                                            ${item.durasi_menit ?? '-'} menit
                                        </span>
                                    </td>
                                    <td>${item.status}</td>
                                    <td>
                                        <a href="/admin/ujian/${item.id}/edit"
                                            class="btn btn-warning btn-sm">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#hapusModal${item.id}">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>

                                </tr>
                            `;
                                });
                            }

                            $('#ujian-body').html(rows);
                            $('#pagination').hide();
                        }
                    });
                }, 400);
            });

            $('#search').on('keyup', function() {
                if ($(this).val() === '') {
                    $('#pagination').show();
                }
            });
        });
    </script>
@endpush
