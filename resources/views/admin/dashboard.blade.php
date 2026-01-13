@extends('bagian.admin.rumah.home')
@section('judul', 'Dashboard') {{-- Pemberian Nama Judul di Web atas --}}
@section('isi')

    @if (Auth::check())
        @if (Auth::user()->role == 'admin')
            <div class="page-inner">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                    <div>
                        <h3 class="fw-bold mb-3">Dashboard Admin</h3>
                        <h6 class="op-7 mb-2">Pusat Kendali Sistem Akademik</h6>
                    </div>
                    <div class="ms-md-auto py-2 py-md-0">
                        <a href="#" class="btn btn-primary btn-round">Selamat Datang</a>
                    </div>
                </div>

                <div class="row">

                    {{-- MAHASISWA --}}
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 d-flex flex-column">
                                        <p class="card-category mb-1">Mahasiswa</p>
                                        <h4 class="card-title">{{ $totalMahasiswa }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- KELAS --}}
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-school"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 d-flex flex-column">
                                        <p class="card-category mb-1">Kelas</p>
                                        <h4 class="card-title">{{ $kelas }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- MAHASISWA AKTIF --}}
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-user-check"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 d-flex flex-column">
                                        <p class="card-category mb-1">User Aktif</p>
                                        <h4 class="card-title">{{ $mahasiswaAktif }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- MAHASISWA NON AKTIF --}}
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                            <i class="fas fa-user-slash"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 d-flex flex-column">
                                        <p class="card-category mb-1">User Non-Aktif</p>
                                        <h4 class="card-title">{{ $mahasiswaTidakAktif }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TOTAL KARYA --}}
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-danger bubble-shadow-small">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 d-flex flex-column">
                                        <p class="card-category mb-1">Total Karya</p>
                                        <h4 class="card-title">{{ $totalKarya }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TOTAL MODUL --}}
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-warning bubble-shadow-small">
                                            <i class="fas fa-book"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 d-flex flex-column">
                                        <p class="card-category mb-1">Total Modul</p>
                                        <h4 class="card-title">{{ $totalModul }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TOTAL VIDEO --}}
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-video"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 d-flex flex-column">
                                        <p class="card-category mb-1">Total Video</p>
                                        <h4 class="card-title">{{ $totalVideo }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- TOTAL DISKUSI --}}
                    <div class="col-sm-6 col-md-3">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small">
                                            <i class="fas fa-comments"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 d-flex flex-column">
                                        <p class="card-category mb-1">Total Diskusi</p>
                                        <h4 class="card-title">{{ $totalDiskusi }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        @endif
    @endif

    @if (Auth::check() && Auth::user()->role == 'mahasiswa')
        <div class="page-inner">

            {{-- HEADER --}}
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard User</h3>
                    <h6 class="op-7 mb-2">Ringkasan aktivitas Anda</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <span class="btn btn-primary btn-round">
                        {{ Auth::user()->nama_lengkap }}
                    </span>
                </div>
            </div>

            {{-- GRID --}}
            <div class="row">

                {{-- MODUL --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3">
                                    <div class="numbers">
                                        <p class="card-category">Modul Saya</p>
                                        <h4 class="card-title">{{ $modulSaya }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- VIDEO --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-video"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3">
                                    <div class="numbers">
                                        <p class="card-category">Video Saya</p>
                                        <h4 class="card-title">{{ $videoSaya }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MATERI / PERPUSTAKAAN --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3">
                                    <div class="numbers">
                                        <p class="card-category">Materi Saya</p>
                                        <h4 class="card-title">{{ $materiSaya }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- KARYA --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-image"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3">
                                    <div class="numbers">
                                        <p class="card-category">Karya Saya</p>
                                        <h4 class="card-title">{{ $karyaSaya }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endif


@endsection
