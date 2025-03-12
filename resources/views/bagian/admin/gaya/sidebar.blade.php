<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="#" class="logo">
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
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item active">
                    <a href="#">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                        {{-- <span class="caret"></span> --}}
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Admin</h4>
                </li>
                {{-- Data Master --}}
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Data Master</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ url('admin/master-modul') }}">
                                    <span class="sub-item">Data Modul</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/master/datavideo') }}">
                                    <span class="sub-item">Data Video</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/master/datazoom') }}">
                                    <span class="sub-item">Data Zoom/Webinar</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('admin/master/') }}">
                                    <span class="sub-item">Data Forum</span>
                                </a>
                            </li>
                            <li>
                                <a href="admin/master/dataperpustakaan">
                                    <span class="sub-item">Data Perpustakaan</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Data Karya Mahasiswa
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Data Ujian/Evaluasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="sub-item">Data Peringkat</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">User</h4>
                </li>
                {{-- Data User --}}
                <li class="nav-item">
                    <a href="#base">
                        <i class="fa-solid fa-user"></i>
                        <p>Data Akun</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
