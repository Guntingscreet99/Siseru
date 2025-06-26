<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="index.html" class="logo d-flex align-items-center me-auto">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="landing/img/logo.png" alt=""> -->
            <h1 class="sitename">RUPAKU!</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                <li><a href="#" class="active">Beranda<br></a></li>
                <li class="dropdown">
                    <a href="#">
                        <span>Materi</span>
                        <i class="bi bi-chevron-down toggle-dorpdown"></i>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ url('admin/dashboard') }}">Modul Pembelajaran</a>
                        </li>
                        <li>
                            <a href="">Video Tutorial</a>
                        </li>
                        <li>
                            <a href="#">Kelas Interaktif & Webinar</a>
                        </li>
                    </ul>
                </li>
                <li><a href="pricing.html">Perpustakaan digital</a></li>
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
                        <li><a href="#">Forum Diskusi </a></li>
                        <li><a href="#">Galeri Karya Mahasiswa</a></li>
                        <li><a href="#">Evaluasi</a></li>
                    </ul>
                </li>
                <li><a href="#">Kontak</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="btn-getstarted" href="{{ url('login') }}">Login</a>

    </div>
</header>
