<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="landing/img/logo.png" alt=""> -->
            <img src="{{ asset('landing/img/logo_UMK.png') }}" alt="RUPAKU Logo" class="me-2" height="500">
            <img src="{{ asset('landing/img/logo_PGSD.png') }}" alt="RUPAKU Logo" class="me-2" height="500">
            <img src="{{ asset('landing/img/LogoRupaku.png') }}" alt="RUPAKU Logo" class="me-2" height="500">
            <h1 class="sitename">RUPAKU!</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            @if (Auth::check())
                @if (Auth::user()->role == 'admin')
                    <ul>
                        <li><a href="{{ route('landing.index') }}" class="active">Beranda<br></a></li>
                        <li class="dropdown">
                            <a href="#">
                                <span>Materi</span>
                                <i class="bi bi-chevron-down toggle-dorpdown"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ url('admin/master-modul') }}">Modul Pembelajaran</a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/master/datavideo') }}">Video Tutorial</a>
                                </li>
                                <li>
                                    <a href="{{ url('admin/master/datazoom') }}">Kelas Interaktif & Webinar</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ url('admin/master/dataperpus') }}">Perpustakaan digital</a></li>
                        <li class="dropdown">
                            <a href="#">
                                <span>Interaktif</span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>
                            <ul>
                                {{-- <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                                    <ul>
                                        <li><a href="#">Deep Dropdown 1</a></li>
                                        <li><a href="#">Deep Dropdown 2</a></li>
                                        <li><a href="#">Deep Dropdown 3</a></li>
                                        <li><a href="#">Deep Dropdown 4</a></li>
                                        <li><a href="#">Deep Dropdown 5</a></li>
                                    </ul>
                                </li> --}}
                                <li><a href="{{ url('admin/master/dataforum') }}">Forum Diskusi </a></li>
                                <li><a href="{{ url('admin/master/datakarya') }}">Galeri Karya Mahasiswa</a></li>
                                <li><a href="{{ url('admin/master/ujian') }}">Ujian/Evaluasi</a></li>
                                <li><a href="{{ url('admin/master/dataperingka') }}">Peringkat</a></li>

                            </ul>
                        </li>
                        <li><a href="#">Kontak</a></li>

                        <form action="{{ url('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-getstarted">Logout</button>
                        </form>
                    </ul>
                @endif
            @endif

            @if (Auth::check())
                @if (Auth::user()->role == 'mahasiswa')
                    <ul>
                        <li><a href="{{ route('landing.index') }}" class="active">Beranda<br></a></li>
                        <li class="dropdown">
                            <a href="#">
                                <span>Materi</span>
                                <i class="bi bi-chevron-down toggle-dorpdown"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="{{ url('user/menu/modul') }}">Modul Pembelajaran</a>
                                </li>
                                <li>
                                    <a href="{{ url('user/menu/video') }}">Video Tutorial</a>
                                </li>
                                <li>
                                    <a href="{{ url('user/menu/zoom') }}">Kelas Interaktif & Webinar</a>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ url('user/menu/perpus') }}">Perpustakaan digital</a></li>
                        <li class="dropdown">
                            <a href="#">
                                <span>Interaktif</span>
                                <i class="bi bi-chevron-down toggle-dropdown"></i>
                            </a>
                            <ul>
                                {{-- <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i
                                            class="bi bi-chevron-down toggle-dropdown"></i></a>
                                    <ul>
                                        <li><a href="#">Deep Dropdown 1</a></li>
                                        <li><a href="#">Deep Dropdown 2</a></li>
                                        <li><a href="#">Deep Dropdown 3</a></li>
                                        <li><a href="#">Deep Dropdown 4</a></li>
                                        <li><a href="#">Deep Dropdown 5</a></li>
                                    </ul>
                                </li> --}}
                                <li><a href="{{ url('user/menu/diskusi') }}">Forum Diskusi </a></li>
                                <li><a href="{{ url('user/menu/galeri') }}">Galeri Karya Mahasiswa</a></li>
                                <li><a href="{{ url('user/menu/ujian') }}">Ujian/Evaluasi</a></li>
                                <li><a href="{{ url('user/menu/peringkat') }}">Peringkat</a></li>
                                <li><a href="{{ url('mahasiswa/data-diri') }}">Data Diri<br></a></li>

                            </ul>
                        </li>
                        <li><a href="#">Kontak</a></li>

                        <form action="{{ url('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-getstarted">Logout</button>
                        </form>
                    </ul>
                @endif

            @endif
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        @guest
            <a class="btn-getstarted" href="{{ url('login') }}">Login</a>
        @endguest

    </div>
</header>
