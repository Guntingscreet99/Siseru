@extends('bagian.user.layout.rumah')
@section('judul', 'Landing Page')
@section('isi')

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{ asset('landing/img/3.jpg') }}" alt="" class="hero-bg" data-aos="fade-in"
            style="filter: brightness(35%);">

        <div class="container">
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <h2 data-aos="fade-up">Sistem Informasi Seni Rupa </h2>
                    <p data-aos="fade-up" data-aos-delay="100">Selamat datang di SISERU!
                        Platform pembelajaran seni rupa yang dirancang untuk membantu Anda mengeksplorasi, belajar, dan
                        mengembangkan keterampilan seni dengan cara yang interaktif dan menyenangkan. Kami percaya bahwa
                        seni adalah bahasa universal yang menghubungkan setiap individu, dan melalui website ini, kami
                        bertujuan untuk memberikan akses ke materi pembelajaran seni rupa yang berkualitas dan mudah
                        diakses oleh siapa saja, di mana saja.</p>

                    {{-- <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="200">
                        <input type="text" class="form-control" placeholder="Your ZIP code or City. e.g. New York">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form> --}}

                    <div class="row gy-4" data-aos="fade-up" data-aos-delay="300">

                        <div class="col-lg-3 col-6">
                            <div class="stats-item text-center w-100 h-100">
                                <span>50</span>
                                <p>Kelas</p>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="stats-item text-center w-100 h-100">
                                <span>521</span>
                                <p>Mahasiswa</p>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="stats-item text-center w-100 h-100">
                                <span>1453</span>
                                <p>Modul</p>
                            </div>
                        </div><!-- End Stats Item -->

                        <div class="col-lg-3 col-6">
                            <div class="stats-item text-center w-100 h-100">
                                <span>32</span>
                                <p>Karya</p>
                            </div>
                        </div><!-- End Stats Item -->

                    </div>

                </div>

                <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
                    <img src="{{ asset('landing/img/1.png') }}" class="img-fluid mb-3 mb-lg-0" alt=""
                        style="border-radius: 50px">
                </div>

            </div>
        </div>

    </section><!-- /Hero Section -->

    <!-- Featured Services Section -->
    <section id="featured-services" class="featured-services section">

        {{-- <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="100">
                    <div class="icon flex-shrink-0"><i class="fa-solid fa-cart-flatbed"></i></div>
                    <div>
                        <h4 class="title">Lorem Ipsum</h4>
                        <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias
                            excepturi sint occaecati cupiditate non provident</p>
                        <a href="#" class="readmore stretched-link"><span>Learn More</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
                <!-- End Service Item -->

                <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="200">
                    <div class="icon flex-shrink-0"><i class="fa-solid fa-truck"></i></div>
                    <div>
                        <h4 class="title">Dolor Sitema</h4>
                        <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                            aliquip ex ea commodo consequat tarad limino ata</p>
                        <a href="#" class="readmore stretched-link"><span>Learn More</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

                <div class="col-lg-4 col-md-6 service-item d-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="icon flex-shrink-0"><i class="fa-solid fa-truck-ramp-box"></i></div>
                    <div>
                        <h4 class="title">Sed ut perspiciatis</h4>
                        <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur</p>
                        <a href="#" class="readmore stretched-link"><span>Learn More</span><i
                                class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->

            </div>

        </div> --}}

    </section><!-- /Featured Services Section -->

    <!-- About Section -->
    <section id="about" class="about section">

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up"
                    data-aos-delay="200">
                    {{-- <video src="{{ asset('landing/img/Seni.mp4') }}" loop autoplay controls
                    style="display: relative; width: 100%; height: auto; border-radius: 20px; margin-top: 50px"></video> --}}

                    <video id="videoPlayer" src="{{ asset('landing/img/Seni.mp4') }}" loop autoplay muted controls
                        style="width: 100%; height: auto; border-radius: 20px; margin-top: 50px;">
                    </video>

                    {{-- <img src="landing/img/about.jpg" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a> --}}
                </div>



                <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                    <h3>Visi Kami</h3>
                    <p>
                        Menjadi platform pembelajaran seni rupa terdepan yang menyatukan teori dan praktik, memberikan
                        wawasan mendalam tentang dunia seni, serta menciptakan ruang bagi para seniman muda untuk berkreasi,
                        berkolaborasi, dan berkembang.
                    </p>
                    <div class="col-lg-6 content order-last  order-lg-first" data-aos="fade-up" data-aos-delay="100">
                        <h3>Misi Kami</h3>
                    </div>
                    <p>
                        1. Menyediakan materi pembelajaran seni rupa yang lengkap dan mudah dipahami, mulai dari konsep
                        dasar hingga tingkat lanjut.
                    </p>
                    <p>
                        2. Membantu mahasiswa untuk mengembangkan keterampilan praktis melalui video tutorial
                        interaktif dan kelas live.
                    </p>
                    <p>
                        3. Menciptakan komunitas pembelajaran yang aktif, di mana setiap orang dapat berdiskusi, berbagi
                        karya, dan mendapatkan feedback yang membangun.
                    </p>
                    <p>
                        4. Mengintegrasikan teknologi dalam proses belajar untuk meningkatkan pengalaman belajar yang lebih
                        efektif dan menyenangkan.
                    </p>
                    {{-- <ul>
                        <li>
                            <i class="bi bi-diagram-3"></i>
                            <div>
                                <h5>Ullamco laboris nisi ut aliquip consequat</h5>
                                <p>Magni facilis facilis repellendus cum excepturi quaerat praesentium libre trade
                                </p>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-fullscreen-exit"></i>
                            <div>
                                <h5>Magnam soluta odio exercitationem reprehenderi</h5>
                                <p>Quo totam dolorum at pariatur aut distinctio dolorum laudantium illo direna
                                    pasata redi</p>
                            </div>
                        </li>
                        <li>
                            <i class="bi bi-broadcast"></i>
                            <div>
                                <h5>Voluptatem et qui exercitationem</h5>
                                <p>Et velit et eos maiores est tempora et quos dolorem autem tempora incidunt maxime
                                    veniam</p>
                            </div>
                        </li>
                    </ul> --}}
                </div>

            </div>

        </div>

    </section><!-- /About Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Kelas Pembelajaran!<br></span>
            <h2>Kelas Pembelajaran!</h2>
            <p>Hal-hal yang dapat kami berikan sebagai berikut!</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div
                            class="card-img
                        {
                            width: 100%; /* Mengisi lebar penuh parent */
                            height: 200px; /* Atur tinggi yang sama */
                            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
                            border-radius: 10px; /* Opsional, untuk tampilan lebih rapi */
                        }">
                            <img src="landing/img/Modul Pembelajaran.avif" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Modul Pembelajaran</a></h3>
                        <p>Berisi materi seni rupa dalam bentuk teks, PDF, infografis, dan e-book.</p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div
                            class="card-img
                        {
                            width: 100%; /* Mengisi lebar penuh parent */
                            height: 200px; /* Atur tinggi yang sama */
                            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
                            border-radius: 10px; /* Opsional, untuk tampilan lebih rapi */
                        }">
                            <img src="landing/img/video interaktif.jpg" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Video Tutorial</a></h3>
                        <p>Video demonstrasi pembuatan karya seni (misalnya menggambar, melukis, membuat kolase).
                            Bisa dalam bentuk streaming atau video yang dapat diunduh.
                        </p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div
                            class="card-img
                        {
                            width: 100%; /* Mengisi lebar penuh parent */
                            height: 200px; /* Atur tinggi yang sama */
                            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
                            border-radius: 10px; /* Opsional, untuk tampilan lebih rapi */
                        }">
                            <img src="landing/img/kelas interaktif.jpg" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Kelas & Webinar</a></h3>
                        <p>ive class menggunakan Zoom atau Google Meet untuk diskusi real-time.
                            Webinar dengan praktisi seni atau dosen tamu untuk memperkaya wawasan mahasiswa</p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card">
                        <div
                            class="card-img
                        {
                            width: 100%; /* Mengisi lebar penuh parent */
                            height: 200px; /* Atur tinggi yang sama */
                            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
                            border-radius: 10px; /* Opsional, untuk tampilan lebih rapi */
                        }">
                            <img src="landing/img/Diskusi.jpg" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Forum Diskusi & Tanya Jawab</a></h3>
                        <p>Wadah untuk mahasiswa bertanya dan berdiskusi tentang seni rupa.
                        </p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="card">
                        <div
                            class="card-img
                        {
                            width: 100%; /* Mengisi lebar penuh parent */
                            height: 200px; /* Atur tinggi yang sama */
                            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
                            border-radius: 10px; /* Opsional, untuk tampilan lebih rapi */
                        }">
                            <img src="landing/img/Galeri seni.jpg" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Gelar Karya Mahasiswa</a></h3>
                        <p>Mahasiswa dapat mengunggah hasil karya seni mereka untuk dikomentari oleh dosen atau teman-teman.
                        </p>
                    </div>
                </div><!-- End Card Item -->

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="card">
                        <div
                            class="card-img
                        {
                            width: 100%; /* Mengisi lebar penuh parent */
                            height: 200px; /* Atur tinggi yang sama */
                            object-fit: cover; /* Memastikan gambar tidak terdistorsi */
                            border-radius: 10px; /* Opsional, untuk tampilan lebih rapi */
                        }">
                            <img src="landing/img/Gamifikasi.jpg" alt="" class="img-fluid">
                        </div>
                        <h3><a href="#" class="stretched-link">Sistem Gamifikasi</a></h3>
                        <p>Poin dan badge untuk mahasiswa yang aktif menyelesaikan modul atau berkontribusi di forum.
                        </p>
                    </div>
                </div><!-- End Card Item -->

            </div>

        </div>

    </section><!-- /Services Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

        <img src="{{ asset('landing/img/2.jpg') }}" alt="">

        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Sudah Punya Akun?</h3>
                        <p>SIlahkan daftarakan diri anda untuk dapat mengakases Materi-materi yang menarik!
                            <br> Silahkan yang merasa dirinya TOBRUT hubungi nomor ini 085.....
                        </p>
                        <a class="cta-btn" href="#">Register</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Call To Action Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Hasil Karya</span>
            <h2>Hasil Karya</h2>
            <p>Hasil Karya terbaik milik mahasiswa akan di tampilkan dan di diskusikan bersama </p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4 align-items-center features-item">
                <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="100">
                    <img src="landing/img/lukisan.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-7" data-aos="fade-up" data-aos-delay="100">
                    <h3>Lukisan Senja.</h3>
                    <p class="fst-italic">
                        Melukis adalah kegiatan mengungkapkan ide, perasaan, atau ekspresi melalui goresan garis, warna, dan
                        bentuk pada suatu media, seperti kanvas, kertas, atau dinding. Seni lukis merupakan bagian dari seni
                        rupa yang menggunakan unsur visual sebagai sarana komunikasi dan ekspresi.
                    </p>
                    <ul>
                        <li><i class="bi bi-check"></i><span> Gunakan Media yang Tepat Pilih media yang sesuai, seperti
                                cat air, cat minyak, atau pensil warna, agar hasil lebih maksimal</span></li>
                        <li><i class="bi bi-check"></i> <span>Eksplorasi Teknik Cobalah berbagai teknik seperti gradasi
                                warna, layering, atau tekstur untuk memperkaya karya.</span></li>
                        <li><i class="bi bi-check"></i> <span>Latihan Rutin Semakin sering melukis, semakin terasah
                                keterampilan dan kreativitas dalam berkarya.</span>
                        </li>
                    </ul>
                </div>
            </div><!-- Features Item -->

            <div class="row gy-4 align-items-center features-item">
                <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out"
                    data-aos-delay="200">
                    <img src="landing/img/batik.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-7 order-2 order-md-1" data-aos="fade-up" data-aos-delay="200">
                    <h3>Batik Tulis</h3>
                    <p class="fst-italic">
                        Batik adalah seni menghias kain dengan pola atau motif tertentu menggunakan malam (lilin) sebagai
                        perintang warna, yang kemudian melalui proses pewarnaan dan pelorodan (penghilangan malam). Batik
                        merupakan salah satu warisan budaya Indonesia yang diakui oleh UNESCO sebagai Warisan Budaya
                        Takbenda sejak 2 Oktober 2009
                    </p>
                    <ul>
                        <li><i class="bi bi-check"></i> <span>UPilih Bahan yang Sesuai Gunakan kain yang menyerap warna
                                dengan baik, seperti katun atau sutra, agar hasil lebih optimal.</span></li>
                        <li><i class="bi bi-check"></i><span> Gunakan Canting dengan Tepat Latih tangan agar stabil saat
                                menggambar motif menggunakan canting untuk mendapatkan garis yang rapi.</span></li>
                        <li><i class="bi bi-check"></i> <span>Eksplorasi Motif Pelajari berbagai motif batik tradisional
                                maupun modern untuk memperluas kreativitas dalam berkarya.</span>.</li>
                    </ul>
                </div>
            </div><!-- Features Item -->

            <div class="row gy-4 align-items-center features-item">
                <div class="col-md-5 d-flex align-items-center" data-aos="zoom-out">
                    <img src="landing/img/patung.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-7" data-aos="fade-up">
                    <h3>Patung</h3>
                    <p>Patung adalah karya seni tiga dimensi yang dibuat dengan teknik memahat, membentuk, atau mencetak
                        bahan seperti kayu, batu, tanah liat, logam, atau fiberglass untuk menghasilkan bentuk yang memiliki
                        nilai estetika atau simbolik. Patung sering digunakan sebagai media ekspresi seni, penghormatan
                        terhadap tokoh, atau elemen dekoratif dalam berbagai budaya.</p>
                    <ul>
                        <li><i class="bi bi-check"></i> <span>Pilih Bahan yang Tepat Gunakan bahan yang sesuai dengan
                                teknik yang dikuasai, seperti tanah liat untuk pemula atau batu dan logam untuk yang lebih
                                mahir.</span></li>
                        <li><i class="bi bi-check"></i><span>Gunakan Alat yang Sesuai Pastikan alat seperti pahat,
                                cetakan, atau alat pemotong digunakan dengan benar untuk mempermudah proses
                                pembentukan.</span></li>
                        <li><i class="bi bi-check"></i> <span>Buat Sketsa atau Model Awal Sebelum mulai membuat patung,
                                buat sketsa atau model kecil sebagai panduan agar hasil akhir lebih sesuai dengan konsep
                                yang diinginkan.</span>.</li>
                    </ul>
                </div>
            </div><!-- Features Item -->

            <div class="row gy-4 align-items-center features-item">
                <div class="col-md-5 order-1 order-md-2 d-flex align-items-center" data-aos="zoom-out">
                    <img src="landing/img/ukiran.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-md-7 order-2 order-md-1" data-aos="fade-up">
                    <h3>Ukiran</h3>
                    <p class="fst-italic">
                        Ukiran adalah seni mengukir atau memahat permukaan suatu bahan, seperti kayu, batu, logam, atau
                        tulang, untuk menciptakan motif, pola, atau bentuk yang memiliki nilai estetika dan makna tertentu.
                        Seni ukir banyak ditemukan dalam berbagai budaya sebagai hiasan pada rumah, perabot, senjata, dan
                        benda seni lainnya.
                    </p>
                    <ul>
                        <li><i class="bi bi-check"></i> <span>Pilih Bahan yang Sesuai Gunakan bahan yang cocok dengan
                                teknik ukiran, seperti kayu jati untuk ukiran kayu atau batu andesit untuk ukiran
                                batu.</span></li>
                        <li><i class="bi bi-check">
                            </i><span>Gunakan Alat yang Tepat Pastikan menggunakan pahat, tatah, atau pisau
                                ukir yang tajam agar hasil lebih rapi dan detail.</span></li>
                        <li><i class="bi bi-check">.</i>
                            <span>Buat Pola atau Sketsa Terlebih Dahulu Membuat sketsa pada bahan
                                sebelum mulai mengukir akan membantu menghasilkan ukiran yang lebih presisi</span>.
                        </li>
                    </ul>
                </div>
            </div><!-- Features Item -->

        </div>

    </section><!-- /Features Section -->

    <!-- Pricing Section -->
    <section id="pricing" class="pricing section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Perpustakaan Digital</span>
            <h2>Perpustakaan Digital</h2>
            <p>Perpustakaan digital adalah sistem perpustakaan berbasis teknologi yang menyediakan koleksi buku, jurnal,
                artikel, dan berbagai sumber informasi dalam format digital. Pengguna dapat mengakses bahan bacaan melalui
                perangkat elektronik seperti komputer, tablet, atau smartphone tanpa harus datang ke perpustakaan fisik.</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row gy-4">

                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="pricing-item">
                        <h3>Modul pembelajaran</h3>
                        <h4><sup></sup>100<span> / Modul</span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Modul pembelajaran terpercaya</span></li>
                            <li><i class="bi bi-check"></i> <span>Cocok untuk pengajar Sekolah Dasar </span></li>
                            <li><i class="bi bi-check"></i> <span>hanya modul yang berkaitan dengan seni rupa</span></li>
                            <li class="na"><i class="bi bi-x"></i> <span>Tidak mencakup seluruh pembelajaran</span>
                            </li>
                            <li class="na"><i class="bi bi-x"></i> <span>Massa ultricies mi quis
                                    hendrerit</span></li>
                        </ul>
                        <a href="#" class="buy-btn">Click Now</a>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="pricing-item featured">
                        <h3>Jurnal</h3>
                        <h4><sup></sup>100<span> / Jurnal</span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                            <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                            <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                            <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                            <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
                        </ul>
                        <a href="#" class="buy-btn">Click Now</a>
                    </div>
                </div><!-- End Pricing Item -->

                <div class="col-lg-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="pricing-item">
                        <h3>Buku</h3>
                        <h4><sup></sup>100<span> / Buku</span></h4>
                        <ul>
                            <li><i class="bi bi-check"></i> <span>Quam adipiscing vitae proin</span></li>
                            <li><i class="bi bi-check"></i> <span>Nec feugiat nisl pretium</span></li>
                            <li><i class="bi bi-check"></i> <span>Nulla at volutpat diam uteera</span></li>
                            <li><i class="bi bi-check"></i> <span>Pharetra massa massa ultricies</span></li>
                            <li><i class="bi bi-check"></i> <span>Massa ultricies mi quis hendrerit</span></li>
                        </ul>
                        <a href="#" class="buy-btn">Click Now</a>
                    </div>
                </div><!-- End Pricing Item -->

            </div>

        </div>

    </section><!-- /Pricing Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

        <img src="landing/img/testimonials-bg.jpg" class="testimonials-bg" alt="">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    }
                }
            </script>
                <div class="swiper-wrapper">

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="landing/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                alt="">
                            <h3>Saul Goodman</h3>
                            <h4>Ceo &amp; Founder</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum
                                    suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et.
                                    Maecen aliquam, risus at semper.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="landing/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                alt="">
                            <h3>Sara Wilsson</h3>
                            <h4>Designer</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum
                                    quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat
                                    irure amet legam anim culpa.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="landing/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                alt="">
                            <h3>Jena Karlis</h3>
                            <h4>Store Owner</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla
                                    quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore
                                    quis sint minim.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="landing/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                alt="">
                            <h3>Matt Brandon</h3>
                            <h4>Freelancer</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                    fugiat minim velit minim dolor enim duis veniam ipsum anim magna sunt elit fore
                                    quem dolore labore illum veniam.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                    <div class="swiper-slide">
                        <div class="testimonial-item">
                            <img src="landing/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                alt="">
                            <h3>John Larson</h3>
                            <h4>Entrepreneur</h4>
                            <div class="stars">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i>
                            </div>
                            <p>
                                <i class="bi bi-quote quote-icon-left"></i>
                                <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor
                                    noster veniam enim culpa labore duis sunt culpa nulla illum cillum fugiat legam
                                    esse veniam culpa fore nisi cillum quid.</span>
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div><!-- End testimonial item -->

                </div>
                <div class="swiper-pagination"></div>
            </div>

        </div>

    </section><!-- /Testimonials Section -->

    <!-- Faq Section -->
    <section id="faq" class="faq section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Frequently Asked Questions</span>
            <h2>Frequently Asked Questions</h2>
            <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
        </div><!-- End Section Title -->

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-lg-10">

                    <div class="faq-container">

                        <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Non consectetur a erat nam at lectus urna duis?</h3>
                            <div class="faq-content">
                                <p>Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus
                                    laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor
                                    rhoncus dolor purus non.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Feugiat scelerisque varius morbi enim nunc faucibus a pellentesque?</h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                    interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                    scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                                    Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Dolor sit amet consectetur adipiscing elit pellentesque?</h3>
                            <div class="faq-content">
                                <p>Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci.
                                    Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl
                                    suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis
                                    convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Ac odio tempor orci dapibus. Aliquam eleifend mi in nulla?</h3>
                            <div class="faq-content">
                                <p>Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id
                                    interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus
                                    scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim.
                                    Mauris ultrices eros in cursus turpis massa tincidunt dui.</p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                        <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                            <i class="faq-icon bi bi-question-circle"></i>
                            <h3>Tempus quam pellentesque nec nam aliquam sem et tortor consequat?</h3>
                            <div class="faq-content">
                                <p>Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse
                                    in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl
                                    suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in
                                </p>
                            </div>
                            <i class="faq-toggle bi bi-chevron-right"></i>
                        </div><!-- End Faq item-->

                    </div>

                </div>

            </div>

        </div>

    </section><!-- /Faq Section -->

@endsection

@push('js')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let video = document.getElementById("videoPlayer");

            // Cek apakah user sebelumnya sudah memutar video
            if (localStorage.getItem("videoPlayed") === "true") {
                video.muted = true; // Pastikan suara aktif
                video.play();
            }

            // Simpan status jika user pertama kali menekan play
            video.addEventListener("play", function() {
                localStorage.setItem("videoPlayed", "true");
            });
        });
    </script>
@endpush
