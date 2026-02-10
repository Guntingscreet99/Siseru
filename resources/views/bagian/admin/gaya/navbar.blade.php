@php
    $user = Auth::user();

    if ($user?->datadiri && $user->datadiri->fotoMhs) {
        $fotoNavbar = asset($user->datadiri->fotoMhs);
    } elseif ($user?->foto) {
        $fotoNavbar = asset($user->foto);
    } else {
        $fotoNavbar = asset('admin/img/profile.jpg');
    }
@endphp

{{-- <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom mt-4"> --}}
<div class="main-header">
    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">

            <!-- tombol toggle sidebar mobile (jika belum pakai offcanvas di sidebar) -->
            <!-- Di dalam <div class="container-fluid"> navbar -->
            <button class="btn btn-toggle sidenav-toggler me-3">
                <i class="gg-menu-right"></i>
            </button>

            <a href="#" class="logo d-flex align-items-center me-auto">
                <img src="{{ asset('landing/img/logo_UMK.png') }}" alt="RUPAKU Logo" class="me-2" height="50">
                <img src="{{ asset('landing/img/logo_PGSD.png') }}" alt="RUPAKU Logo" class="me-2" height="50">
                <img src="{{ asset('landing/img/LogoRupaku.png') }}" alt="RUPAKU Logo" class="me-2" height="55">
            </a>

            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <img src="{{ $fotoNavbar }}" class="avatar-img rounded-circle" style="object-fit: cover;">

                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold">{{ Auth::user()->nama_lengkap ?? '-' }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-lg">
                                        <img src="{{ $fotoNavbar }}" class="avatar-img rounded"
                                            style="object-fit: cover; width:100%; height:100%;">
                                    </div>
                                    <div class="u-text">
                                        <h4>{{ Auth::user()->nim ?? '-' }}</h4>
                                        <p class="text-muted">{{ Auth::user()->nama_lengkap ?? '-' }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('mahasiswa/data-diri') }}">Data
                                    Diri</a>
                                <a class="dropdown-item" href="{{ route('landing.index') }}">Beranda</a>
                                <div class="dropdown-divider"></div>
                                <form action="{{ url('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning"
                                        style="margin-left: 5px;">Keluar</button>
                                </form>
                            </li>
                        </div>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</div>
