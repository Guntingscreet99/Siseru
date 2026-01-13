@extends('bagian.admin.rumah.home')
@section('judul', 'Rekap Forum Diskusi')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>Rekap Forum</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="judul1 mb-3">
                            <h5 class="text-center fw-bold">
                                Rekap Diskusi per User per Topik
                            </h5>
                            <span>
                                Tanggal :
                                <strong>
                                    {{ $rekap->isNotEmpty() ? optional($rekap->first()->forum)->created_at?->format('d-m-Y') ?? '-' : '-' }}
                                </strong>
                            </span>
                        </div>
                        <hr>
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-3">
                                <form method="GET" action="{{ url('admin/rekap/forum') }}"
                                    class="d-flex align-items-center gap-2">
                                    <select name="kelas" class="form-control form-control-sm">
                                        <option value="">-- Pilih Kelas --</option>
                                        @if ($kelas->isNotEmpty())
                                            @foreach ($kelas as $kel)
                                                <option value="{{ $kel->id }}"
                                                    {{ request('kelas') == $kel->id ? 'selected' : '' }}>
                                                    {{ $kel->nama_kelas }}
                                                </option>
                                            @endforeach
                                        @else
                                            <option value="" disabled>Tidak ada kelas tersedia</option>
                                        @endif
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-info">
                                        Filter
                                    </button>
                                </form>
                            </div>

                            <!-- SHOW ENTRIES -->
                            <div class="col-md-4">
                                <form method="GET" action="" class="d-flex align-items-center gap-2">
                                    <label for="entries" class="mb-0">Show</label>
                                    <select name="entries" id="entries" onchange="this.form.submit()"
                                        class="form-control form-control-sm w-auto">
                                        <option value="10" {{ request('entries') == 10 ? 'selected' : '' }}>10</option>
                                        <option value="25" {{ request('entries') == 25 ? 'selected' : '' }}>25</option>
                                        <option value="50" {{ request('entries') == 50 ? 'selected' : '' }}>50</option>
                                        <option value="100" {{ request('entries') == 100 ? 'selected' : '' }}>100
                                        </option>
                                    </select>

                                    {{-- pertahankan filter lain --}}
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                    <input type="hidden" name="kelas" value="{{ request('kelas') }}">
                                </form>
                            </div>

                            <!-- SEARCH -->
                            <div class="col-md-5">
                                <form method="GET" action=""
                                    class="d-flex align-items-center gap-2 justify-content-end">
                                    <input type="text" name="search" class="form-control form-control-sm"
                                        placeholder="Search..." value="{{ request('search') }}">

                                    {{-- pertahankan filter lain --}}
                                    <input type="hidden" name="entries" value="{{ request('entries', 10) }}">
                                    <input type="hidden" name="kelas" value="{{ request('kelas') }}">

                                    <button type="submit" class="btn btn-sm btn-primary">
                                        Search
                                    </button>
                                </form>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>Topik</th>
                                        <th>Jumlah Pesan</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($rekap as $item)
                                        <tr>
                                            <td>{{ $rekap->firstItem() + $loop->index }}</td>
                                            <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $item->user->datadiri->kelas->nama_kelas ?? '-' }}</td>
                                            <td>{{ $item->user->datadiri->semester->nama_semester ?? '-' }}</td>
                                            <td>{{ $item->forum->topik ?? '-' }}</td>
                                            <td>{{ $item->jumlah_pesan }}</td>
                                            <td>
                                                @if ($item->jumlah_pesan >= 20)
                                                    100
                                                @elseif ($item->jumlah_pesan >= 15)
                                                    90
                                                @elseif ($item->jumlah_pesan >= 10)
                                                    80
                                                @elseif ($item->jumlah_pesan >= 5)
                                                    75
                                                @else
                                                    70
                                                @endif
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                @if (request('kelas'))
                                                    Data tidak ada untuk kelas yang dipilih
                                                @elseif (request('search'))
                                                    Data tidak ditemukan dengan kata kunci tersebut
                                                @else
                                                    Belum ada data diskusi
                                                @endif
                                            </td>
                                        </tr>
                                    @endempty
                            </tbody>
                        </table>
                    </div>
                    <div class="halaman mt-2">
                        {{ $rekap->appends(request()->except('page'))->links() }}
                    </div>

                    <h5 class="text-center fw-bold">3 User Tercepat (Total Pesan Keseluruhan)</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-success">
                                <tr>
                                    <th>Rank</th>
                                    <th>Nama</th>
                                    <th>Total Pesan</th>
                                    <th>Nilai (berdasarkan total)</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @forelse ($topUsers as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->user->nama_lengkap ?? 'Unknown' }}</td>
                                        <td>{{ $user->total_pesan }}</td>
                                        <td>
                                            @if ($user->total_pesan >= 20)
                                                100
                                            @elseif ($user->total_pesan >= 15)
                                                90
                                            @elseif ($user->total_pesan >= 10)
                                                80
                                            @elseif ($user->total_pesan >= 5)
                                                75
                                            @else
                                                70
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted py-4">
                                            @if (request('kelas'))
                                                Tidak ada user aktif di kelas yang dipilih
                                            @elseif (request('search'))
                                                Tidak ditemukan user dengan kata kunci tersebut
                                            @else
                                                Belum ada data
                                            @endif
                                        </td>
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
