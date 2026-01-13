@extends('bagian.admin.rumah.home')
@section('judul', 'Rekap Data Ujian')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>Rekap Ujian</h1>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-body">

                        <form action="{{ route('admin.rekap.ujian.import') }}" method="POST" enctype="multipart/form-data"
                            id="uploadForm">
                            @csrf

                            {{-- LABEL --}}
                            <div class="mb-2">
                                <label class="fw-bold">
                                    Upload File Excel
                                </label>
                                <small class="text-danger d-block fst-italic">
                                    * Format: xlsx, xls, csv — gunakan format resmi
                                </small>
                            </div>

                            {{-- BARIS SEJAJAR --}}
                            <div class="row g-2 align-items-stretch">

                                {{-- INPUT FILE --}}
                                <div class="col-md-7">
                                    <input type="file" name="file" id="file" class="form-control h-100" required>
                                </div>

                                {{-- BUTTON UPLOAD --}}
                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn btn-primary h-100" id="uploadButton">
                                        <i class="fa-solid fa-upload me-1"></i>
                                        Upload
                                    </button>
                                </div>

                                {{-- BUTTON DOWNLOAD --}}
                                <div class="col-md-3 d-grid">
                                    <a href="{{ route('admin.rekap.format') }}" class="btn btn-success h-100">
                                        <i class="fa-solid fa-file-excel me-1"></i>
                                        Download Format
                                    </a>
                                </div>

                            </div>
                        </form>

                        {{-- LOADING --}}
                        <div id="loading" class="mt-3 text-primary d-none">
                            <div class="spinner-border spinner-border-sm" role="status"></div>
                            <span class="ms-2">Mengunggah file, mohon tunggu...</span>
                        </div>

                    </div>
                </div>


                <div class="card">
                    <div class="card-body">

                        <div class="judul1 mb-3">
                            <h5 class="text-center fw-bold">
                                Rekap Nilai Ujian per Mahasiswa
                            </h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Tanggal Upload:</strong>
                                    {{ $lastUpload ? $lastUpload->created_at->translatedFormat('d F Y H:i') : '-' }}
                                </div>

                                <div class="col-md-6 text-end">
                                    <strong>Status Data:</strong>
                                    {{ $lastUpdate ? 'Terupdate ' . $lastUpdate->updated_at->diffForHumans() : '-' }}
                                </div>
                            </div>

                        </div>
                        <hr>
                        <div class="row mb-3 align-items-center">
                            <div class="col-md-3">
                                <form method="GET" action="{{ url('admin/rekap/ujian') }}"
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
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>Judul</th>
                                        <th>Nilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($rekap as $item)
                                        <tr>
                                            <td>{{ $rekap->firstItem() + $loop->index }}</td>
                                            <td>{{ $item->user->nim ?? '-' }}</td>
                                            <td>{{ $item->user->nama_lengkap ?? '-' }}</td>
                                            <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                            <td>{{ $item->semester->nama_semester ?? '-' }}</td>
                                            <td>{{ $item->dataujian->ujian ?? 'Kosong' }}</td>
                                            <td>
                                                <span class="badge bg-success">{{ $item->score }} / 100</span>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-danger"
                                                    onclick="confirmDelete({{ $item->kdujian }})">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-muted py-4 text-center">
                                                @if (request('kelas'))
                                                    Data tidak tersedia untuk kelas tersebut
                                                @elseif (request('search'))
                                                    Data tidak ditemukan
                                                @else
                                                    Belum ada data ujian
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                        <div class="halaman mt-2">
                            {{-- {{ $rekap->appends(request()->except('page'))->links() }} --}}
                            {{ $rekap->links() }}
                        </div>

                        {{-- <h5 class="text-center fw-bold">3 Mahasiswa dengan Nilai Tertinggi</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-success">
                                    <tr>
                                        <th>Rank</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Nilai Tertinggi</th>
                                        <th>Kategori Nilai</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    @forelse ($topUsers as $key => $user)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $user->user->datadiri->nim ?? '-' }}</td>
                                            <td>{{ $user->user->nama_lengkap ?? 'Unknown' }}</td>
                                            <td>{{ $user->total_nilai }}</td>
                                            <td>
                                                @if ($user->total_nilai >= 90)
                                                    A (Sangat Baik)
                                                @elseif ($user->total_nilai >= 80)
                                                    B (Baik)
                                                @elseif ($user->total_nilai >= 70)
                                                    C (Cukup)
                                                @else
                                                    D (Kurang)
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                @if (request('kelas'))
                                                    Tidak ada mahasiswa aktif di kelas yang dipilih
                                                @elseif (request('search'))
                                                    Tidak ditemukan mahasiswa dengan kata kunci tersebut
                                                @else
                                                    Belum ada data
                                                @endif
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.rekap.ujian.hapus')


    @push('js')
        <script>
            document.getElementById('uploadForm').addEventListener('submit', function(e) {
                e.preventDefault();

                const form = this;
                const formData = new FormData(form);

                const loading = document.getElementById('loading');
                const button = document.getElementById('uploadButton');

                loading.classList.remove('d-none');
                button.disabled = true;

                fetch("{{ route('admin.rekap.ujian.import') }}", {
                        method: "POST",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(res => {
                        loading.classList.add('d-none');
                        button.disabled = false;

                        if (res.status) {
                            alert(res.message);
                            window.location.href = "{{ route('admin.rekap.ujian') }}";
                        } else {
                            alert(res.message ?? 'Import gagal');
                        }
                    })
                    .catch(error => {
                        loading.classList.add('d-none');
                        button.disabled = false;
                        alert('Terjadi kesalahan saat upload');
                        console.error(error);
                    });
            });
        </script>
    @endpush

    @push('css')
        <style>
            ul.pagination,
            ul.pagination * {
                font-size: 14px !important;
                line-height: 1.4 !important;
            }

            ul.pagination li a,
            ul.pagination li span {
                padding: 6px 12px !important;
                min-width: auto !important;
                height: auto !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
            }

            /* Target SVG langsung - ini yang paling ampuh untuk kasus Tailwind */
            ul.pagination svg {
                width: 1em !important;
                /* atau 14px, 16px */
                height: 1em !important;
                margin: 0 !important;
            }

            /* Jika masih pakai font icon */
            ul.pagination i {
                font-size: 14px !important;
            }

            /* Agar pagination tidak terlalu lebar / lebih estetik */
            .pagination {
                flex-wrap: wrap;
                gap: 4px;
            }
        </style>
    @endpush

@endsection
