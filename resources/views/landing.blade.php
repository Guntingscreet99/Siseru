<x-user.layout.rumah title="Landing Page">
    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

        <img src="{{ asset('landing/img/3.jpg') }}" alt="" class="hero-bg" data-aos="fade-in"
            style="filter: brightness(35%);">

        <div class="container">
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <div class="hero-text">
                        <h2 class="title-art" data-aos="fade-up">
                            RUANG APRESIASI<br><strong>SENI RUPA</strong>
                        </h2>

                        <p class="desc-art" data-aos="fade-up" data-aos-delay="100">
                            Selamat datang di <strong>RUPAKU.</strong> Sebuah ruang digital yang didedikasikan untuk
                            mengeksplorasi dan mengembangkan potensi seni rupa Anda. Melalui pengalaman belajar
                            interaktif, kami menjadikan seni sebagai bahasa universal yang menyatukan. Akses materi
                            berkualitas tinggi secara mudah dan biarkan kreativitas Anda berkembang tanpa batasan ruang
                            dan waktu.
                        </p>
                    </div>


                    {{-- <form action="#" class="form-search d-flex align-items-stretch mb-3" data-aos="fade-up"
                        data-aos-delay="200">
                        <input type="text" class="form-control" placeholder="Your ZIP code or City. e.g. New York">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form> --}}

                    <div class="row g-4 art-stats">

                        @php
                            $stats = [
                                [
                                    'icon' => 'fa-users',
                                    'value' => $totalMahasiswa,
                                    'label' => 'Mahasiswa',
                                ],
                                [
                                    'icon' => 'fa-school',
                                    'value' => $kelas,
                                    'label' => 'Kelas',
                                ],
                                [
                                    'icon' => 'fa-user-check',
                                    'value' => $mahasiswaAktif,
                                    'label' => 'User Aktif',
                                ],
                                [
                                    'icon' => 'fa-user-slash',
                                    'value' => $mahasiswaTidakAktif,
                                    'label' => 'User Non-Aktif',
                                ],
                            ];
                        @endphp

                        <div class="row art-stats text-center">
                            @foreach ($stats as $item)
                                <div class="col-6 col-md-3">
                                    <div class="art-stat-item" data-type="{{ $item['label'] }}">
                                        <i class="fas {{ $item['icon'] }}"></i>
                                        <div class="art-stat-value">{{ $item['value'] }}</div>
                                        <div class="art-stat-label">{{ $item['label'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

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
                        wawasan mendalam tentang dunia seni, serta menciptakan ruang bagi para seniman muda untuk
                        berkreasi,
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
                        4. Mengintegrasikan teknologi dalam proses belajar untuk meningkatkan pengalaman belajar yang
                        lebih
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

    <!-- Kelas Pembelajaran -->
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
                            <img src="{{ asset('landing/img/Modul-Pembelajaran.avif') }}" alt=""
                                class="img-fluid">
                        </div>
                        <h3><a href="{{ url('user/menu/modul') }}" class="stretched-link">Modul Pembelajaran</a></h3>
                        <p>Berisi materi seni rupa dalam bentuk teks, PDF, infografis, dan buku digital.</p>
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
                            <img src="{{ asset('landing/img/video-interaktif.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <h3><a href="{{ url('user/menu/video') }}" class="stretched-link">Video Tutorial</a></h3>
                        <p>Pelajari berbagai teknik menggambar, melukis, dan membuat kolase melalui video demonstrasi
                            interaktif. Akses secara <em>streaming</em> atau unduh video untuk belajar kapan saja.
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
                            <img src="{{ asset('landing/img/kelas-interaktif.jpg') }}" alt=""
                                class="img-fluid">
                        </div>
                        <h3><a href="{{ url('user/menu/zoom') }}" class="stretched-link">Kelas Interaktif</a></h3>
                        <p>Ikuti kelas langsung <em>(live class)</em> menggunakan Zoom atau Google Meet untuk diskusi
                            waktu nyata
                            <em>(real-time)</em>. Selain itu, tersedia <em>webinar</em> bersama praktisi seni atau dosen
                            tamu guna
                            memperkaya wawasan mahasiswa.
                        </p>
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
                            <img src="{{ asset('landing/img/Diskusi.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <h3><a href="{{ url('user/menu/diskusi') }}" class="stretched-link">Forum Diskusi & Tanya
                                Jawab</a></h3>
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
                            <img src="{{ asset('landing/img/Galeri-seni.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <h3><a href="{{ url('user/menu/galeri') }}" class="stretched-link">Gelar Karya
                                Mahasiswa</a></h3>
                        <p>Mahasiswa dapat mengunggah hasil karya seni rupa untuk dikomentari oleh dosen atau
                            teman-teman.
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
                            <img src="{{ asset('landing/img/Gamifikasi.jpg') }}" alt="" class="img-fluid">
                        </div>
                        <h3><a href="{{ url('user/menu/peringkat') }}" class="stretched-link">Sistem Peringkat</a>
                        </h3>
                        <p>Dapatkan poin dan lencana sebagai apresiasi atas keaktifan Anda dalam menyelesaikan modul
                            atau berkontribusi di forum diskusi.
                        </p>
                    </div>
                </div><!-- End Card Item -->

            </div>

        </div>

    </section><!-- /Services Section -->

    <!-- Register -->
    <section id="call-to-action" class="call-to-action section dark-background">

        <img src="{{ asset('landing/img/2.jpg') }}" alt="">

        <div class="container">
            <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
                <div class="col-xl-10">
                    <div class="text-center">
                        <h3>Sudah Punya Akun?</h3>
                        <p>Silahkan daftarakan diri anda untuk dapat mengakases Materi-materi yang menarik!
                        </p>
                        <a class="cta-btn" href="{{ url('register') }}">Daftar akun</a>
                    </div>
                </div>
            </div>
        </div>

    </section><!-- /Call To Action Section -->

    <!-- Hasil Karya -->
    <section id="features" class="features section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <span>Hasil Karya</span>
            <h2>Hasil Karya</h2>
            <p>Hasil Karya terbaik milik mahasiswa akan ditampilkan dan didiskusikan bersama</p>
        </div>

        <div class="container">

            @foreach ($karya as $index => $item)
                @php
                    $filePath = $item->fileKarya ?? $item->judulFileAsli;
                    $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                    $isVideo = in_array($extension, ['mp4', 'mkv', 'avi', 'webm']);
                    $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
                    $fileUrl = Storage::url($filePath);
                    $reverse = $index % 2 != 0;
                @endphp

                <div class="row gy-2 align-items-center features-item mb-5">

                    {{-- MEDIA --}}
                    <div class="col-md-5 {{ $reverse ? 'order-1 order-md-2' : '' }} d-flex align-items-center justify-content-center"
                        data-aos="zoom-out">
                        @if ($isVideo)
                            <video class="img-fluid rounded shadow-sm media-hover" controls
                                style="max-height: 450px; width: auto;">
                                <source src="{{ $fileUrl }}" type="video/{{ $extension }}">
                                Browser tidak mendukung video.
                            </video>
                        @elseif ($isImage)
                            <img src="{{ $fileUrl }}" class="img-fluid rounded shadow-sm media-hover"
                                style="max-height: 450px; width: auto;" alt="{{ $item->namaKarya }}">
                        @else
                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-secondary">
                                <i class="fas fa-file"></i> Unduh File
                            </a>
                        @endif
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="col-md-7 {{ $reverse ? 'order-2 order-md-1' : '' }}" data-aos="fade-up">
                        <div class="desc-card p-3 rounded shadow-sm">
                            <h3 class="fw-bold text-primary">{{ $item->namaKarya }}</h3>

                            <p class="fst-italic text-dark mb-2" style="font-size: 0.95rem; margin-bottom: 0.5rem;">
                                {{ $item->deskripsi }}
                            </p>

                            <ul class="list-unstyled mb-2">
                                <li class="mb-1">
                                    <i class="bi bi-person-circle text-secondary me-2"></i>
                                    <span><strong>Nama Mahasiswa:</strong> {{ $item->namaMhs }}</span>
                                </li>
                                <li class="mb-1">
                                    <i class="bi bi-building text-secondary me-2"></i>
                                    <span><strong>Kelas:</strong> {{ $item->kelas->nama_kelas }}</span>
                                </li>
                                <li class="mb-1">
                                    <i class="bi bi-calendar-event text-secondary me-2"></i>
                                    <span><strong>Semester:</strong> {{ $item->semester->nama_semester }}</span>
                                </li>
                            </ul>

                            {{-- Badges Info Mahasiswa --}}
                            <div class="mt-2 d-flex flex-wrap gap-1">
                                <span class="badge bg-primary badge-hover">Mahasiswa: {{ $item->namaMhs }}</span>
                                <span class="badge bg-info badge-hover">Kelas: {{ $item->kelas->nama_kelas }}</span>
                                <span class="badge bg-success badge-hover">Semester:
                                    {{ $item->semester->nama_semester }}</span>
                            </div>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>

    </section>

    <!-- /Features Section -->

    <!-- Pricing Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section dark-background">

        <img src="{{ asset('landing/img/testimonials-bg.jpg') }}" class="testimonials-bg" alt="">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            @if ($testimonis->count())
                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": { "delay": 5000 },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    }
                }
                </script>

                    <div class="swiper-wrapper">

                        @foreach ($testimonis as $testi)
                            <div class="swiper-slide">
                                <div class="testimonial-item">

                                    {{-- FOTO --}}
                                    <img src="{{ $testi->user && $testi->user->dataDiri && $testi->user->dataDiri->fotoMhs
                                        ? Storage::url($testi->user->dataDiri->fotoMhs)
                                        : asset('landing/img/profil_dasar.png') }}"
                                        class="testimonial-img"
                                        alt="Foto {{ $testi->user->nama_lengkap ?? 'Mahasiswa' }}">

                                    {{-- NAMA --}}
                                    <h3>{{ $testi->user->nama_lengkap ?? 'Mahasiswa' }}</h3>
                                    <h4>Mahasiswa</h4>

                                    {{-- RATING --}}
                                    <div class="stars">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="bi bi-star-fill {{ $i <= $testi->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                        @endfor
                                    </div>

                                    {{-- PESAN --}}
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        <span>{{ $testi->pesan }}</span>
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>

                                </div>
                            </div>
                        @endforeach

                    </div>

                    <div class="swiper-pagination"></div>
                </div>
            @else
                {{-- JIKA BELUM ADA TESTIMONI --}}
                <div class="text-center text-light py-5">
                    <h4>Belum ada testimoni mahasiswa</h4>
                    <p>Testimoni akan muncul setelah disetujui admin.</p>
                </div>
            @endif

        </div>
    </section>

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

    @push('css')
        <style>
            /* ===============================
                                                                                                                    Tipografi Estetik untuk Ruang Seni
                                                                                                                                =============================== */
            .title-art {
                font-family: 'Poppins', sans-serif;
                font-weight: 700;
                font-size: 2.5rem;
                color: #ffffff;
                line-height: 1.2;
                letter-spacing: 1px;
                text-transform: uppercase;
                text-align: center;
                margin-bottom: 1rem;
            }

            .desc-art {
                font-family: 'Roboto', sans-serif;
                font-size: 1.1rem;
                color: #ffffff;
                line-height: 1.8;
                text-align: center;
                max-width: 800px;
                margin: 0 auto;
                letter-spacing: 0.3px;
            }

            /* Tambahan subtle highlight pada nama platform */
            .desc-art strong {
                color: #ff1500;
                /* warna coral aesthetic */
                font-weight: 600;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .title-art {
                    font-size: 2rem;
                }

                .desc-art {
                    font-size: 1rem;
                }
            }

            /* ===============================
                                                                                                                                                                                Hover efek & scaling
                                                                                                                                                                            =============================== */
            .hover-scale {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .hover-scale:hover {
                transform: translateY(-5px) scale(1.03);
                box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
            }

            .hover-scale-sm {
                transition: transform 0.2s;
            }

            .hover-scale-sm:hover {
                transform: scale(1.05);
            }

            /* ===============================
                                                                                                                                                                                Media Hover (Gambar/Video)
                                                                                                                                                                           =============================== */
            .media-hover {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: pointer;
            }

            .media-hover:hover {
                transform: scale(1.05);
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
            }

            /* ===============================
                                                                                                                                                                                Card Deskripsi Hasil Karya
                                                                                                                                                                           =============================== */
            .desc-card {
                background: linear-gradient(135deg, #ffffff 0%, #f1f6ff 100%);
                transition: transform 0.3s ease, box-shadow 0.3s ease;
            }

            .desc-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
            }

            /* ===============================
                                                                                                                                                                                Badge Info Mahasiswa
                                                                                                                                                                           =============================== */
            .badge-hover {
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                cursor: default;
            }

            .badge-hover:hover {
                transform: scale(1.1);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            /* ===============================
                                                                                                                                                                                Responsive untuk mobile
                                                                                                                                                                           =============================== */
            @media (max-width: 768px) {
                .desc-card h3 {
                    font-size: 1.25rem;
                }

                .desc-card p {
                    font-size: 0.85rem;
                }

                .media-hover {
                    max-height: 300px;
                }
            }

            /* =====================================================
                                                                                                   HERO — OVERRIDE TERKONTROL (TIDAK GANGGU LAINNYA)
                                                                                                   ===================================================== */

            /* Wrapper agar judul & paragraf sejajar */
            #hero .hero-text {
                max-width: 540px;
            }

            /* Judul */
            #hero .title-art {
                font-family: 'Playfair Display', serif;
                text-align: left;
                margin-bottom: 1.2rem;
            }

            /* Paragraf */
            #hero .desc-art {
                text-align: justify;
                text-justify: inter-word;
                hyphens: auto;
                margin: 0;
            }


            /* Highlight nama platform */
            #hero .desc-art strong {
                color: #ff784f;
                font-weight: 600;
            }

            /* Responsive HERO text */
            @media (max-width: 768px) {
                #hero .title-art {
                    font-size: 2.2rem;
                    text-align: center;
                }

                #hero .desc-art {
                    text-align: center;
                    margin: 0 auto;
                }
            }

            /* =====================================================
                                                                                                   ART STATS — TYPOGRAPHY FIRST (GEN Z / ART)
                                                                                                   ===================================================== */

            #hero .art-stats {
                margin-top: 3rem;
            }

            #hero .art-stat-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: .35rem;
                padding: .75rem 0;
                transition: transform .35s ease;
            }

            #hero .art-stat-item:hover {
                transform: translateY(-6px);
            }

            /* ICON */
            #hero .art-stat-item i {
                font-size: 2.6rem;
                margin-bottom: .3rem;
                opacity: .95;
            }

            /* ANGKA = ELEMEN SENI */
            #hero .art-stat-value {
                font-family: 'Bebas Neue', sans-serif;
                font-size: 2.8rem;
                letter-spacing: .18em;
                line-height: 1;
                color: #ffffff;
            }

            /* LABEL */
            #hero .art-stat-label {
                font-family: 'Inter', sans-serif;
                font-size: .65rem;
                letter-spacing: .35em;
                text-transform: uppercase;
                color: rgba(255, 255, 255, .75);
            }

            /* =====================================================
                                                                                                   WARNA ICON BERDASARKAN MAKNA
                                                                                                   (TIDAK PENGARUH KE ICON LAIN)
                                                                                                   ===================================================== */

            #hero .art-stat-item[data-type="Mahasiswa"] i {
                color: #ff784f;
                /* human / komunitas */
            }

            #hero .art-stat-item[data-type="Kelas"] i {
                color: #5cc8ff;
                /* edukasi */
            }

            #hero .art-stat-item[data-type="User Aktif"] i {
                color: #6ee7b7;
                /* aktif / hidup */
            }

            #hero .art-stat-item[data-type="UserNon-Aktif"] i {
                color: #a1a1aa;
                /* redup */
            }

            /* =====================================================
                                                                                                   MOBILE REFINEMENT
                                                                                                   ===================================================== */

            @media (max-width: 576px) {
                #hero .art-stat-item i {
                    font-size: 2.1rem;
                }

                #hero .art-stat-value {
                    font-size: 2.2rem;
                }
            }
        </style>
    @endpush

</x-user.layout.rumah>
