@extends('bagian.admin.rumah.home')
@section('judul', 'Rekap Data Nilai Akhir')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="judul mb-4">
                <h1 class="fw-bold mb-3">
                    <i class="fas fa-file-contract text-primary"></i>
                    Rekap Data Nilai Akhir
                </h1>


                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.rekap.generate') }}" method="POST" class="mb-3">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sync"></i> Generate Rekap Nilai
                            </button>
                        </form>

                        <form action="{{ route('admin.rekap.index') }}" method="GET">
                            <div class="row g-3 align-items-end">
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Nilai Huruf</label>
                                    <select name="nilai" class="form-select">
                                        <option value="semua">-- Semua Nilai --</option>
                                        @foreach (['A', 'AB', 'B', 'BC', 'C', 'CD', 'D', 'E'] as $n)
                                            <option value="{{ $n }}"
                                                {{ request('nilai') == $n ? 'selected' : '' }}>
                                                {{ $n }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Pilih Kelas</label>
                                    <select name="kelas_id" class="form-select">
                                        <option value="">-- Semua Kelas --</option>
                                        @foreach ($kelas as $kel)
                                            <option value="{{ $kel->id }}">{{ $kel->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-bold">Pilih Semester</label>
                                    <select name="semester_id" class="form-select">
                                        <option value="">-- Semua Semester --</option>
                                        @foreach ($semester as $sem)
                                            <option value="{{ $sem->id }}">{{ $sem->nama_semester }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 d-flex gap-2">
                                    <button type="submit" class="btn btn-info text-white">
                                        <i class="fas fa-search"></i> Filter
                                    </button>
                                    <a href="{{ route('admin.rekap.index') }}" class="btn btn-primary">
                                        <i class="fa-solid fa-arrow-rotate-left"></i> Reset
                                    </a>
                                    <a href="{{ route('rekap.export', request()->query()) }}" class="btn btn-success">
                                        <i class="fa-solid fa-file-excel"></i> Export Excel
                                    </a>
                                </div>
                            </div>
                        </form>

                        <hr class="my-4">

                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-center">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama / NIM</th>
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>Nilai</th>
                                        <th>Huruf</th>
                                        <th>Bobot</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($rekap as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>

                                            <td class="text-start">
                                                <strong>{{ $item->nama_lengkap }}</strong><br>
                                                <small>{{ $item->nim }}</small>
                                            </td>

                                            <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                            <td>{{ $item->semester->nama_semester ?? '-' }}</td>

                                            <td>{{ number_format($item->nilai_angka ?? 0, 2) }}</td>
                                            <td><strong>{{ $item->grade->huruf ?? '-' }}</strong></td>
                                            <td>{{ $item->grade->bobot ?? '-' }}</td>
                                            <td>{{ $item->grade->kategori ?? '-' }}</td>

                                            <td>
                                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#detailNilai{{ $item->id }}">
                                                    <i class="fas fa-eye"></i> Detail
                                                </button>

                                                {{-- MODAL DETAIL NILAI --}}
                                                <div class="modal fade" id="detailNilai{{ $item->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                                        <div class="modal-content shadow">

                                                            {{-- HEADER --}}
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title fw-bold">
                                                                    <i class="fas fa-user-graduate me-2"></i>
                                                                    Detail Nilai Mahasiswa
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal"></button>
                                                            </div>

                                                            {{-- BODY --}}
                                                            <div class="modal-body">

                                                                {{-- IDENTITAS --}}
                                                                <div class="card mb-3 border-0 shadow-sm">
                                                                    <div class="card-body">
                                                                        <h6 class="fw-bold mb-1">{{ $item->nama_lengkap }}
                                                                        </h6>
                                                                        <small class="text-muted">
                                                                            NIM: {{ $item->nim }} |
                                                                            Kelas: {{ $item->kelas->nama_kelas ?? '-' }} |
                                                                            Semester:
                                                                            {{ $item->semester->nama_semester ?? '-' }}
                                                                        </small>
                                                                    </div>
                                                                </div>

                                                                {{-- RINCIAN NILAI --}}
                                                                <div class="card border-0 shadow-sm mb-3">
                                                                    <div class="card-header bg-light fw-bold">
                                                                        <i class="fas fa-chart-bar me-2"></i>Rincian Nilai
                                                                    </div>
                                                                    <div class="card-body">

                                                                        {{-- NILAI KARYA --}}
                                                                        <label class="fw-semibold">Nilai Karya</label>
                                                                        <div class="progress mb-3" style="height: 20px;">
                                                                            <div class="progress-bar bg-info"
                                                                                style="width: {{ $item->rekap_karya }}%">
                                                                                {{ number_format($item->rekap_karya, 2) }}
                                                                            </div>
                                                                        </div>

                                                                        {{-- NILAI UJIAN --}}
                                                                        <label class="fw-semibold">Nilai Ujian</label>
                                                                        <div class="progress mb-3" style="height: 20px;">
                                                                            <div class="progress-bar bg-warning"
                                                                                style="width: {{ $item->rekap_ujian }}%">
                                                                                {{ number_format($item->rekap_ujian, 2) }}
                                                                            </div>
                                                                        </div>

                                                                        {{-- NILAI DISKUSI --}}
                                                                        <label class="fw-semibold">Nilai Diskusi</label>
                                                                        <div class="progress mb-3" style="height: 20px;">
                                                                            <div class="progress-bar bg-secondary"
                                                                                style="width: {{ $item->rekap_diskusi }}%">
                                                                                {{ number_format($item->rekap_diskusi, 2) }}
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                {{-- NILAI AKHIR --}}
                                                                <div class="card border-0 shadow-sm text-center">
                                                                    <div class="card-body">
                                                                        <h6 class="text-muted mb-1">Nilai Akhir</h6>
                                                                        <h2 class="fw-bold mb-0">
                                                                            {{ number_format($item->nilai_angka, 2) }}
                                                                        </h2>
                                                                        <span class="badge bg-dark fs-6 mt-2">
                                                                            {{ $item->grade->huruf }} | Bobot
                                                                            {{ $item->grade->bobot }}
                                                                        </span>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            {{-- FOOTER --}}
                                                            <div class="modal-footer">
                                                                @if ($item->grade->lulus)
                                                                    <span class="badge bg-success me-auto fs-6">
                                                                        <i class="fas fa-check-circle me-1"></i>
                                                                        Lulus – {{ $item->grade->kategori }}
                                                                    </span>
                                                                @else
                                                                    <span class="badge bg-danger me-auto fs-6">
                                                                        <i class="fas fa-times-circle me-1"></i>
                                                                        Tidak Lulus – {{ $item->grade->kategori }}
                                                                    </span>
                                                                @endif

                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">
                                                                    Tutup
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center">Data tidak ditemukan</td>
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
