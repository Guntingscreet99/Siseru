@extends('bagian.user.rumah.home')
@section('judul', 'Peringkat Mahasiswa')
@section('isi')

    <div class="container">
        <div class="page-inner">

            <div class="card shadow-sm">

                {{-- HEADER --}}
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0 fw-bold">
                        <i class="fas fa-trophy me-2"></i> Peringkat Mahasiswa
                    </h4>
                </div>

                <div class="card-body">

                    {{-- FILTER CARD --}}
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body py-3">
                            <form method="GET" action="{{ route('user.peringkat.index') }}">
                                <div class="row g-3 align-items-end">

                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Kelas</label>
                                        <select name="kelas_id" class="form-select">
                                            <option value="">Semua Kelas</option>
                                            @foreach ($kelas as $kel)
                                                <option value="{{ $kel->id }}"
                                                    {{ request('kelas_id') == $kel->id ? 'selected' : '' }}>
                                                    {{ $kel->nama_kelas }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Semester</label>
                                        <select name="semester_id" class="form-select">
                                            <option value="">Semua Semester</option>
                                            @foreach ($semester as $sem)
                                                <option value="{{ $sem->id }}"
                                                    {{ request('semester_id') == $sem->id ? 'selected' : '' }}>
                                                    {{ $sem->nama_semester }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-4 d-flex gap-2">
                                        <button type="submit" class="btn btn-outline-info w-100">
                                            <i class="fas fa-search me-1"></i> Filter
                                        </button>
                                        <a href="{{ route('user.peringkat.index') }}"
                                            class="btn btn-outline-secondary w-100">
                                            <i class="fa-solid fa-arrow-rotate-left me-1"></i> Reset
                                        </a>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle text-center mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Peringkat</th>
                                    <th>Nama / NIM</th>
                                    <th>Kelas</th>
                                    <th>Semester</th>
                                    <th>Nilai Akhir</th>
                                    <th>IPK</th>
                                    <th>Grade</th>
                                    <th>Status</th>
                                    <th>Detail</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($peringkat as $item)
                                    <tr>
                                        <td>
                                            @if ($item->peringkat == 1)
                                                <span class="badge bg-warning text-dark">🥇 #1</span>
                                            @elseif ($item->peringkat == 2)
                                                <span class="badge bg-secondary text-dark">🥈 #2</span>
                                            @elseif ($item->peringkat == 3)
                                                <span class="badge"
                                                    style="background-color:#cd7f32; color:rgb(0, 0, 0);">🥉
                                                    #3</span>
                                            @else
                                                <span class="badge bg-light text-dark">
                                                    #{{ $item->peringkat }}
                                                </span>
                                            @endif
                                        </td>

                                        <td class="text-start">
                                            <strong>{{ $item->nama_lengkap }}</strong><br>
                                            <small class="text-muted">{{ $item->nim }}</small>
                                        </td>

                                        <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                                        <td>{{ $item->semester->nama_semester ?? '-' }}</td>

                                        <td class="fw-bold">
                                            {{ number_format($item->nilai_angka, 2) }}
                                        </td>

                                        <td class="fw-bold">
                                            {{ number_format($item->grade->bobot ?? 0, 2) }}
                                        </td>

                                        <td>
                                            <span class="badge bg-info">
                                                {{ $item->grade->huruf }}
                                            </span>
                                        </td>

                                        <td>
                                            <span class="badge {{ $item->grade->lulus ? 'bg-success' : 'bg-danger' }}">
                                                {{ $item->grade->lulus ? 'Lulus' : 'Tidak Lulus' }}
                                            </span>
                                        </td>

                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                                data-bs-target="#detailNilai{{ $item->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">
                                            Data peringkat belum tersedia
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

    {{-- MODAL (DIPISAH, AGAR RAPI) --}}
    {{-- MODAL DETAIL PERINGKAT --}}
    @foreach ($peringkat as $item)
        <div class="modal fade" id="detailNilai{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content shadow">

                    {{-- HEADER --}}
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title fw-bold">
                            <i class="fas fa-user-graduate me-2"></i>
                            Detail Nilai Mahasiswa
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    {{-- BODY --}}
                    <div class="modal-body">

                        {{-- IDENTITAS --}}
                        <div class="card mb-3 border-0 shadow-sm">
                            <div class="card-body">
                                <h6 class="fw-bold mb-1">{{ $item->nama_lengkap }}</h6>
                                <small class="text-muted">
                                    NIM: {{ $item->nim }} |
                                    Kelas: {{ $item->kelas->nama_kelas ?? '-' }} |
                                    Semester: {{ $item->semester->nama_semester ?? '-' }}
                                </small>
                            </div>
                        </div>

                        {{-- RINCIAN NILAI --}}
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-header bg-light fw-bold">
                                <i class="fas fa-chart-bar me-2"></i> Rincian Nilai
                            </div>
                            <div class="card-body">

                                {{-- NILAI KARYA --}}
                                <label class="fw-semibold">Nilai Karya</label>
                                <div class="progress mb-3" style="height: 20px;">
                                    <div class="progress-bar bg-info" style="width: {{ $item->rekap_karya }}%">
                                        {{ number_format($item->rekap_karya, 2) }}
                                    </div>
                                </div>

                                {{-- NILAI UJIAN --}}
                                <label class="fw-semibold">Nilai Ujian</label>
                                <div class="progress mb-3" style="height: 20px;">
                                    <div class="progress-bar bg-warning" style="width: {{ $item->rekap_ujian }}%">
                                        {{ number_format($item->rekap_ujian, 2) }}
                                    </div>
                                </div>

                                {{-- NILAI DISKUSI --}}
                                <label class="fw-semibold">Nilai Diskusi</label>
                                <div class="progress mb-3" style="height: 20px;">
                                    <div class="progress-bar bg-secondary" style="width: {{ $item->rekap_diskusi }}%">
                                        {{ number_format($item->rekap_diskusi, 2) }}
                                    </div>
                                </div>

                            </div>
                        </div>

                        {{-- NILAI AKHIR --}}
                        <div class="card border-0 shadow-sm text-center">
                            <div class="card-body">
                                <h6 class="text-muted mb-1">Nilai Akhir</h6>
                                <h2 class="fw-bold mb-0">{{ number_format($item->nilai_angka, 2) }}</h2>
                                <span class="badge bg-dark fs-6 mt-2">
                                    {{ $item->grade->huruf ?? '-' }} | IPK: {{ $item->grade->bobot ?? 0 }}
                                </span>
                            </div>
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer">
                        @if ($item->grade->lulus)
                            <span class="badge bg-success me-auto fs-6">
                                <i class="fas fa-check-circle me-1"></i>
                                Lulus – {{ $item->grade->kategori ?? '-' }}
                            </span>
                        @else
                            <span class="badge bg-danger me-auto fs-6">
                                <i class="fas fa-times-circle me-1"></i>
                                Tidak Lulus – {{ $item->grade->kategori ?? '-' }}
                            </span>
                        @endif

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Tutup
                        </button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach


@endsection
