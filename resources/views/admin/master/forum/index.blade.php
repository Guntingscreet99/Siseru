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

                        <!-- Tombol Tambah + Search -->
                        <div class="mb-3"
                            style="display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;">
                            <div class="form-group">
                                <a href="{{ url('admin/forum/tampil') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Forum Diskusi
                                </a>
                            </div>
                            <div class="form-group" style="display: flex; align-items: center; gap: 5px;">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Cari forum..." style="width: 300px;">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Tabel Forum -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center"
                                style="white-space: nowrap; overflow-x: auto; width: 100%">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Topik Forum</th>
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th>Sisa Waktu</th>
                                        <th>Dibuat</th>
                                        <th>File</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="forum-body">
                                    @if ($forum->isEmpty())
                                        <tr>
                                            <td colspan="10" class="text-center py-4 text-muted">
                                                <h5>Belum ada forum diskusi</h5>
                                            </td>
                                        </tr>
                                    @else
                                        @foreach ($forum as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                                <td>{{ $item->created_at->format('H:i') }} Wib</td>
                                                <td class="text-start fw-bold">{{ $item->topik }}</td>
                                                <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                                <td>{{ $item->semester->nama_semester ?? '-' }}</td>
                                                <td>
                                                    <span class="badge bg-info fs-6">
                                                        {{ $item->durasi_menit }} menit
                                                    </span>
                                                </td>
                                                <td>
                                                    @if (!$item->waktu_selesai)
                                                        <span class="badge bg-secondary">Tanpa Batas</span>
                                                    @elseif(now()->greaterThan($item->waktu_selesai))
                                                        <span class="badge bg-danger">Ditutup</span>
                                                    @else
                                                        <span class="badge bg-success">Aktif</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($item->waktu_selesai && now()->lessThan($item->waktu_selesai))
                                                        <span class="text-success fw-bold">
                                                            {{ now()->diffForHumans($item->waktu_selesai, ['parts' => 2]) }}
                                                        </span>
                                                        <small class="d-block text-muted">
                                                            ({{ now()->diffInMinutes($item->waktu_selesai) }} menit lagi)
                                                        </small>
                                                    @elseif($item->waktu_selesai)
                                                        <span class="text-danger">Sudah lewat</span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                                <td>
                                                    @if ($item->fileForum)
                                                        <a href="{{ asset('storage/' . $item->fileForum) }}"
                                                            target="_blank" class="btn btn-sm btn-success">
                                                            <i class="fas fa-file-download"></i> Unduh
                                                        </a>
                                                    @else
                                                        <span class="text-muted">Tidak ada</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/forum/ubah/' . $item->kdforum) }}"
                                                        class="btn btn-warning btn-sm">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#Hapus{{ $item->kdforum }}">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </button>

                                                    <!-- Modal Hapus -->
                                                    <div class="modal fade" id="Hapus{{ $item->kdforum }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Hapus Forum Diskusi</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"></button>
                                                                </div>
                                                                <div class="modal-body text-center">
                                                                    <h5 class="mt-2 mb-3">
                                                                        Yakin ingin menghapus forum:<br>
                                                                        <strong>"{{ $item->topik }}"</strong>?
                                                                    </h5>
                                                                </div>
                                                                <div class="modal-footer justify-content-center">
                                                                    <form
                                                                        action="{{ url('admin/forum-hapus/' . $item->kdforum) }}"
                                                                        method="POST" style="display:inline">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">
                                                                            <i class="fas fa-trash"></i> Ya, Hapus
                                                                        </button>
                                                                    </form>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        Batal
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                    location.reload();
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
                                    `<tr><td colspan="10" class="text-center py-4">Data tidak ditemukan</td></tr>`;
                            } else {
                                $.each(data, function(index, item) {
                                    let status = '';
                                    if (!item.waktu_selesai) {
                                        status =
                                            '<span class="badge bg-secondary">Tanpa Batas</span>';
                                    } else if (new Date() > new Date(item
                                            .waktu_selesai)) {
                                        status =
                                            '<span class="badge bg-danger">Ditutup</span>';
                                    } else {
                                        status =
                                            '<span class="badge bg-success">Aktif</span>';
                                    }

                                    rows += `
                            <tr>
                                <td>${index + 1}</td>
                                <td class="text-start fw-bold">${item.topik}</td>
                                <td>${item.kelas?.nama_kelas || '-'}</td>
                                <td>${item.semester?.nama_semester || '-'}</td>
                                <td><span class="badge bg-info">${item.durasi_menit} menit</span></td>
                                <td>${status}</td>
                                <td class="text-muted small">${item.created_at}</td>
                                <td>
                                    <a href="admin/forum/ubah/${item.kdforum}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-pen"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#Hapus${item.kdforum}">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </td>
                            </tr>`;
                                });
                            }
                            $('#forum-body').html(rows);
                        },
                        error: function() {
                            alert('Gagal mencari data');
                        }
                    });
                }, 500);
            });
        });
    </script>
@endpush
