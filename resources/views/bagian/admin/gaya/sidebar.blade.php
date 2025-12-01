<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ url('admin/dashboard') }}" class="logo">
                <img src="{{ asset('admin/img/kaiadmin/logo_light.svg') }}" alt="navbar brand" class="navbar-brand"
                    height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-menu-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                @if (Auth::check())
                    @if (Auth::user()->role == 'admin')
                        <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Data</h4>
                        </li>
                        <!-- Data Master -->
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#base-collapse"
                                class="{{ request()->is('admin/master/kelas', 'admin/master/semester', 'admin/master/akun') ? 'active' : '' }}">
                                <i class="fas fa-layer-group"></i>
                                <p>Data Master</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/master/kelas', 'admin/master/semester', 'admin/master/akun') ? 'show' : '' }}"
                                id="base-collapse" data-bs-parent="">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('admin/master/kelas') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/kelas') }}">
                                            <span class="sub-item">Data Kelas</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/semester') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/semester') }}">
                                            <span class="sub-item">Data Semester</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/akun') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/akun') }}">
                                            <span class="sub-item">Data Akun</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Data Menu -->
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#menu-collapse"
                                class="{{ request()->is('admin/master/datavideo', 'admin/master/datazoom', 'admin/master/dataperpus', 'admin/master/peringkat') ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                                <p>Data Menu</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/master/datavideo', 'admin/master/datazoom', 'admin/master/dataperpus', 'admin/master/peringkat') ? 'show' : '' }}"
                                id="menu-collapse" data-bs-parent="">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('admin/master/datavideo') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/datavideo') }}">
                                            <span class="sub-item">Data Video</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/datazoom') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/datazoom') }}">
                                            <span class="sub-item">Data Zoom/Webinar</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/dataperpus') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/dataperpus') }}">
                                            <span class="sub-item">Data Perpustakaan</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/dataperingkat') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/dataperingkat') }}">
                                            <span class="sub-item">Data Peringkat</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Data Menu Mahasiswa (Terpisah) -->
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#mahasiswa-collapse"
                                class="{{ request()->is('admin/master-modul', 'admin/master/dataforum', 'admin/master/datakarya', 'admin/master/ujian') ? 'active' : '' }}">
                                <i class="fas fa-list"></i>
                                <p>Data Menu Mahasiswa</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/master-modul', 'admin/master/dataforum', 'admin/master/datakarya', 'admin/master/ujian') ? 'show' : '' }}"
                                id="mahasiswa-collapse" data-bs-parent="">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('admin/master-modul') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master-modul') }}">
                                            <span class="sub-item">Data Modul</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/dataforum') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/dataforum') }}">
                                            <span class="sub-item">Data Forum</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/datakarya') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/datakarya') }}">
                                            <span class="sub-item">Data Karya Mahasiswa</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/dataujian') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/dataujian') }}">
                                            <span class="sub-item">Data Ujian/Evaluasi</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- Data User -->
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Rekap Data User</h4>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#base-collapse"
                                class="{{ request()->is('admin/master/kelas', 'admin/master/semester', 'admin/master/akun') ? 'active' : '' }}">
                                <i class="fa-solid fa-user"></i>
                                <p>Data User</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/master/', 'admin/master/semester', 'admin/master/akun') ? 'show' : '' }}"
                                id="base-collapse" data-bs-parent="">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('admin/forum/rekap-download/') ? 'active' : '' }}">
                                        <a href="{{ url('admin/forum/rekap-download/') }}">
                                            <span class="sub-item">Data Forum Diskusi</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/semester') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/semester') }}">
                                            <span class="sub-item">Data Galeri Karya</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/akun') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/akun') }}">
                                            <span class="sub-item">Data Modul Belajar</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/akun') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/akun') }}">
                                            <span class="sub-item">Ujian & Evaluasi</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/akun') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/akun') }}">
                                            <span class="sub-item">Perpustakaan Digital</span>
                                        </a>
                                    </li>
                                    <li class="{{ request()->is('admin/master/akun') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/akun') }}">
                                            <span class="sub-item">Peringkat</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        {{-- <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">User</h4>
                        </li>
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#base-collapse"
                                class="{{ request()->is('admin/master/kelas', 'admin/master/semester', 'admin/master/akun') ? 'active' : '' }}">
                                <i class="fa-solid fa-user"></i>
                                <p>Data Akun</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ request()->is('admin/master/', 'admin/master/semester', 'admin/master/akun') ? 'show' : '' }}"
                                id="base-collapse" data-bs-parent="">
                                <ul class="nav nav-collapse">
                                    <li class="{{ request()->is('admin/master/kelas') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/kelas') }}">
                                            <span class="sub-item">Data Akun Admin</span>
                                        </a>
                                    </li>
                                    {{-- <li class="{{ request()->is('admin/master/semester') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/semester') }}">
                                            <span class="sub-item">Data Semester</span>
                                        </a>
                                    </li> --}}
                        {{-- <li class="{{ request()->is('admin/master/akun') ? 'active' : '' }}">
                                        <a href="{{ url('admin/master/akun') }}">
                                            <span class="sub-item">Data Akun User</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li> --}}
                    @elseif (Auth::user()->role == 'dosen')
                        <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('admin/dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    @elseif (Auth::user()->role == 'mahasiswa')
                        <li class="nav-item {{ request()->is('mahasiswa/dashboard') ? 'active' : '' }}">
                            <a href="{{ url('mahasiswa/dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Menu Utama</h4>
                        </li>

                        <!-- Forum -->
                        <li class="nav-item {{ request()->is('user/menu/forum') ? 'active' : '' }}">
                            <a href="{{ url('user/menu/forum') }}">
                                <i class="fas fa-comments"></i>
                                <p>Forum Diskusi</p>
                            </a>
                        </li>

                        <!-- Galeri / Karya -->
                        <li class="nav-item {{ request()->is('user/menu/galeri') ? 'active' : '' }}">
                            <a href="{{ url('user/menu/galeri') }}">
                                <i class="fas fa-images"></i>
                                <p>Galeri Karya</p>
                            </a>
                        </li>

                        <!-- Modul -->
                        <li class="nav-item {{ request()->is('user/menu/modul') ? 'active' : '' }}">
                            <a href="{{ url('user/menu/modul') }}">
                                <i class="fas fa-book-open"></i>
                                <p>Modul Belajar</p>
                            </a>
                        </li>

                        <!-- Ujian / Evaluasi -->
                        <li class="nav-item {{ request()->is('user/menu/ujian') ? 'active' : '' }}">
                            <a href="{{ url('user/menu/ujian') }}">
                                <i class="fas fa-file-alt"></i>
                                <p>Ujian & Evaluasi</p>
                            </a>
                        </li>

                        <!-- Video Pembelajaran -->
                        <li class="nav-item {{ request()->is('user/menu/video') ? 'active' : '' }}">
                            <a href="{{ url('user/menu/video') }}">
                                <i class="fas fa-video"></i>
                                <p>Video Pembelajaran</p>
                            </a>
                        </li>

                        <!-- Perpustakaan -->
                        <li class="nav-item {{ request()->is('user/menu/perpus') ? 'active' : '' }}">
                            <a href="{{ url('user/menu/perpus') }}">
                                <i class="fas fa-book"></i>
                                <p>Perpustakaan Digital</p>
                            </a>
                        </li>

                        <!-- Peringkat / Leaderboard -->
                        <li class="nav-item {{ request()->is('user/menu/peringkat') ? 'active' : '' }}">
                            <a href="{{ url('user/menu/peringkat') }}">
                                <i class="fas fa-trophy"></i>
                                <p>Peringkat</p>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
