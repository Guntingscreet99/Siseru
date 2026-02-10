<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('judul')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />

    @include('bagian.admin.gaya.css')
    @stack('css')
    <!-- CSS tambahan untuk fix sidebar offcanvas di mobile/tablet -->
    <style>
        @media (max-width: 991.98px) {

            /* Force semua teks di dalam offcanvas jadi putih/cerah */
            #sidebarOffcanvas,
            #sidebarOffcanvas * {
                color: #ffffff !important;
            }

            /* Khusus heading section (MENU UTAMA dll) */
            #sidebarOffcanvas .text-section,
            #sidebarOffcanvas .nav-section h4,
            #sidebarOffcanvas .nav-section .text-section {
                color: #ffffff !important;
                opacity: 1 !important;
                font-weight: 600 !important;
            }

            /* Item menu utama & ikon */
            #sidebarOffcanvas .nav-secondary>.nav-item>a,
            #sidebarOffcanvas .nav-secondary>.nav-item>a>i,
            #sidebarOffcanvas .nav-secondary>.nav-item>a>p,
            #sidebarOffcanvas .nav-secondary .nav-link {
                color: #f0f0f0 !important;
                /* lebih cerah dari #e0e0e0 */
            }

            /* Hover & active state */
            #sidebarOffcanvas .nav-secondary .nav-item>a:hover,
            #sidebarOffcanvas .nav-secondary .nav-item.active>a,
            #sidebarOffcanvas .nav-secondary .nav-item.active>a>i,
            #sidebarOffcanvas .nav-secondary .nav-item.active>a>p {
                color: #ffffff !important;
                background: rgba(23, 125, 255, 0.25) !important;
                /* biru agak lebih kuat biar kontras */
            }

            /* Submenu */
            #sidebarOffcanvas .nav-collapse .nav-item a,
            #sidebarOffcanvas .nav-collapse .sub-item {
                color: #e8e8e8 !important;
            }

            #sidebarOffcanvas .nav-collapse .nav-item a:hover,
            #sidebarOffcanvas .nav-collapse .sub-item:hover {
                color: #ffffff !important;
                background: rgba(255, 255, 255, 0.08) !important;
            }

            /* Logo header di sidebar */
            #sidebarOffcanvas .logo-header,
            #sidebarOffcanvas .logo-header * {
                color: #ffffff !important;
                background-color: #000000 !important;
            }

            /* Hilangkan opacity/muted yang mungkin override */
            #sidebarOffcanvas .text-muted,
            #sidebarOffcanvas [class*="opacity-"] {
                color: #ffffff !important;
                opacity: 1 !important;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('bagian.admin.gaya.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            @php
                $user = Auth::user();

                if ($user?->datadiri && $user->datadiri->fotoMhs) {
                    $fotoNavbar = asset('storage/' . $user->datadiri->fotoMhs);
                } elseif ($user?->foto) {
                    $fotoNavbar = asset('storage/' . $user->foto);
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
                        <button class="navbar-toggler d-lg-none me-3" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#sidebarOffcanvas" aria-controls="sidebarOffcanvas" aria-expanded="false"
                            aria-label="Toggle sidebar">
                            <i class="fa-solid fa-bars text-white"></i>
                        </button>

                        <a href="#" class="logo d-flex align-items-center me-auto">
                            <img src="{{ asset('landing/img/logo_UMK.png') }}" alt="RUPAKU Logo" class="me-2"
                                height="50">
                            <img src="{{ asset('landing/img/logo_PGSD.png') }}" alt="RUPAKU Logo" class="me-2"
                                height="50">
                            <img src="{{ asset('landing/img/LogoRupaku.png') }}" alt="RUPAKU Logo" class="me-2"
                                height="55">
                        </a>

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ $fotoNavbar }}" class="avatar-img rounded-circle"
                                            style="object-fit: cover;">

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

            @include('bagian.admin.gaya.navbar')

            <section>
                @yield('isi')
            </section>

            @include('bagian.admin.gaya.footer')
        </div>

        <!-- Custom template | don't include it in your project! -->
        <div class="custom-template">
            <div class="title">Settings</div>
            <div class="custom-content">
                <div class="switcher">
                    <div class="switch-block">
                        <h4>Logo Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                            <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Navbar Header</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeTopBarColor" data-color="dark"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                            <button type="button" class="changeTopBarColor" data-color="green"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange"></button>
                            <button type="button" class="changeTopBarColor" data-color="red"></button>
                            <button type="button" class="selected changeTopBarColor" data-color="white"></button>
                            <br />
                            <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                            <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                            <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                            <button type="button" class="changeTopBarColor" data-color="green2"></button>
                            <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                            <button type="button" class="changeTopBarColor" data-color="red2"></button>
                        </div>
                    </div>
                    <div class="switch-block">
                        <h4>Sidebar</h4>
                        <div class="btnSwitch">
                            <button type="button" class="changeSideBarColor" data-color="white"></button>
                            <button type="button" class="selected changeSideBarColor" data-color="dark"></button>
                            <button type="button" class="changeSideBarColor" data-color="dark2"></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="custom-toggle">
                <i class="icon-settings"></i>
            </div>
        </div>
        <!-- End Custom template -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Cek session success
        @if (session('success'))
            Swal.fire({
                position: "center",
                icon: "success",
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // Cek errors
        @if ($errors->any())
            Swal.fire({
                icon: "error",
                title: "Terjadi Kesalahan!",
                html: `
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
                showConfirmButton: true,
                confirmButtonText: "OK"
            });
        @endif
    </script>

    @include('bagian.admin.gaya.js')
    @stack('js')

</body>

</html>
