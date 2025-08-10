{{-- <x-user.layout.rumah title="Galeri Karya">
    <section id="hero" class="hero section dark-background">

        <img src="{{ asset('User/img/painting_1.jpg') }}" alt="" class="hero-bg" data-aos="fade-in"
            style="filter: brightness(40%);">

        <div class="container">
            <div class="row gy-4 d-flex justify-content-between">
                <div class="col-lg-12 order-2 order-lg-1 d-flex flex-column justify-content-center">
                    <div class="card-body">
                        <div class="card-title text-center mb-4">
                            <div class="background" style="background-image: {{ asset('landing/img/lukisan.jpg') }}">
                                <h3>
                                    Galeri Karya
                                </h3>
                                <a href="{{ url('mahasiswa/dashboard') }}"class="btn btn-primary">
                                    Kembali
                                </a>
                            </div>
                        </div>
                        <div class="container">
                            <div class="bg-gray-300 max-w-[900px] mx-auto flex flex-col gap-2 p-2">
                                <!-- Search and Category -->
                                <div class="flex gap-2">
                                    <button class="bg-gray-300 font-bold px-4 py-1">Cari</button>
                                    <button class="bg-gray-300 font-bold px-4 py-1">Kategori</button>
                                </div>

                                <!-- Title -->
                                <div class="text-center font-bold text-sm">
                                    <div>Hasil Karya</div>
                                    <div>Dasboard / Landing</div>
                                </div>

                                <!-- Main content area -->
                                <main class="flex gap-2">
                                    <!-- Left form -->
                                    <form class="flex flex-col gap-2 bg-gray-300 p-2 w-[40%] min-w-[220px]">
                                        <input type="text" placeholder="Nama Mahasiswa" class="font-bold px-2 py-1"
                                            aria-label="Nama Mahasiswa" />
                                        <input type="text" placeholder="Kelas" class="font-bold px-2 py-1"
                                            aria-label="Kelas" />
                                        <input type="text" placeholder="Semester" class="font-bold px-2 py-1"
                                            aria-label="Semester" />
                                        <input type="text" placeholder="Nama Karya" class="font-bold px-2 py-1"
                                            aria-label="Nama Karya" />
                                        <input type="text" placeholder="Deskripsi Karya" class="font-bold px-2 py-1"
                                            aria-label="Deskripsi Karya" />
                                        <input type="file" class="font-bold px-2 py-1 bg-white"
                                            aria-label="File Karya" />
                                    </form>

                                    <!-- Center image/video placeholder -->
                                    <div class="bg-white font-bold flex items-center justify-center w-[40%] min-w-[220px]"
                                        style="min-height: 180px;" aria-label="Gambar/Video Karya">
                                        Gambar/Video Karya
                                    </div>



                                    <!-- Buttons below form and image -->
                                    <div class="flex gap-2 px-2">
                                        <button class="bg-indigo-600 text-black font-bold px-4 py-2">Simpan</button>
                                        <button class="bg-red-600 text-black font-bold px-4 py-2">Hapus</button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="testimonials" class="testimonials section dark-background">

        <img src="{{ asset('User/img/painting_1.jpg') }}" class="testimonials-bg" alt="">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="bg-gray-300 max-w-[900px] mx-auto flex flex-col gap-2 p-2">
                <div class="menu-items">
                    <div class="menu-item" data-id="1">
                        <img src="https://cdn.pixabay.com/photo/2023/09/25/22/08/ai-generated-8276129_1280.jpg"
                            alt="Signature Burger" class="item-image" />
                        <div class="item-details">
                            <div class="item-tags">
                                <span class="item-tag">Bestseller</span>
                            </div>
                            <h3 class="item-name">Signature Burger</h3>
                            <p class="item-description">
                                Premium beef patty with fresh lettuce, tomato, onion, pickles,
                                and our secret signature sauce.
                            </p>
                            <div class="item-bottom">
                                <span class="item-price">$9.99</span>
                                <button class="add-to-cart"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                    <div class="menu-item" data-id="2">
                        <img src="https://cdn.pixabay.com/photo/2022/08/29/17/44/burger-7419420_1280.jpg"
                            alt="Double Cheese Deluxe" class="item-image" />
                        <div class="item-details">
                            <div class="item-tags">
                                <span class="item-tag">Popular</span>
                            </div>
                            <h3 class="item-name">Double Cheese Deluxe</h3>
                            <p class="item-description">
                                Two juicy beef patties with double cheddar cheese, caramelized
                                onions, and special sauce.
                            </p>
                            <div class="item-bottom">
                                <span class="item-price">$12.99</span>
                                <button class="add-to-cart"><i class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                            <img src="{{ asset('landing/img/lukisan.jpg') }}" class="testimonial-img" alt="">
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
                            <img src="{{ asset('landing/img/testimonials/testimonials-2.jpg') }}"
                                class="testimonial-img" alt="">
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
                            <img src="{{ asset('landing/img/testimonials/testimonials-3.jpg') }}"
                                class="testimonial-img" alt="">
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
                            <img src="{{ asset('landing/img/testimonials/testimonials-4.jpg') }}"
                                class="testimonial-img" alt="">
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
                            <img src="{{ asset('landing/img/testimonials/testimonials-5.jpg') }}"
                                class="testimonial-img" alt="">
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

    </section>
</x-user.layout.rumah> --}}

@extends('bagian.admin.rumah.home')
@section('judul', 'User | Data Karya')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="mb-3" style="display: flex; justify-content: space-between">
                            <div class="form-group">
                                <a href="{{ url('admin/karya/tampil') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Tambah Data Karya
                                </a>
                                {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahguru">
                                 <i class="fas fa-plus"></i> Tambah Data Agama
                            </button> --}}
                            </div>
                            <div class="form-group" style="display: flex; align-items: center;">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Cari..." style="width: 70%;">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-responsive table-striped table-bordered text-center"
                                style="white-space: nowrap; overflow-x: auto; width: 100%">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Nama Mahasiswa</th>
                                        <th scope="col">Kelas</th>
                                        <th scope="col">Semester</th>
                                        <th scope="col">Nama Karya</th>
                                        <th scope="col">Deskripsi Karya</th>
                                        <th scope="col">File Karya</th>
                                        <th scope="col">Status Karya</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="karya-body">
                                    @if ($karya->isEmpty())
                                        <tr>
                                            <td colspan="9" class="text-center">Data Masih Kosong</td>
                                        </tr>
                                    @else
                                        @foreach ($karya as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item->namaMhs }}</td>
                                                <td>{{ $item->kelas->nama_kelas }}</td>
                                                <td>{{ $item->semester->nama_semester }}</td>
                                                <td>{{ $item->namaKarya }}</td>
                                                <td>{{ $item->deskripsi }}</td>
                                                {{-- <td>
                                                    <a href="{{ $item->link }}" target="_blank">
                                                        {{ $item->link }}
                                                    </a>
                                                </td> --}}
                                                <td>
                                                    <!-- Tombol atau elemen untuk memicu modal -->
                                                    @if ($item->fileKarya)
                                                        @php
                                                            $fileExtension = pathinfo(
                                                                Storage::path($item->fileKarya),
                                                                PATHINFO_EXTENSION,
                                                            );
                                                            $isVideo = in_array(strtolower($fileExtension), [
                                                                'mp4',
                                                                'mkv',
                                                                'avi',
                                                            ]);
                                                            $isImage = in_array(strtolower($fileExtension), [
                                                                'jpg',
                                                                'jpeg',
                                                                'png',
                                                            ]);
                                                        @endphp

                                                        <button type="button" class="btn btn-link view-media"
                                                            data-bs-toggle="modal" data-bs-target="#mediaModal"
                                                            data-src="{{ Storage::url($item->fileKarya) }}"
                                                            data-type="{{ $isVideo ? 'video' : ($isImage ? 'image' : 'unknown') }}">
                                                            @if ($isVideo)
                                                                <i class="fas fa-video"></i> Lihat Video
                                                            @elseif ($isImage)
                                                                <i class="fas fa-image"></i> Lihat Gambar
                                                            @else
                                                                <i class="fas fa-file"></i> Lihat File
                                                            @endif
                                                        </button>

                                                        <!-- Modal -->
                                                        <div class="modal fade" id="mediaModal" tabindex="-1"
                                                            role="dialog" aria-labelledby="mediaModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-lg" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="mediaModalLabel">
                                                                            Pratinjau Media</h5>
                                                                        <button type="button" class="close"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div id="mediaContent">
                                                                            <!-- Konten media akan dimuat di sini oleh JavaScript -->
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Tutup</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <p>Tidak ada File Karya</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <form method="POST" action="{{ url('admin/karya/update-status') }}">
                                                        @csrf
                                                        <input type="hidden" name="kdkarya" value="{{ $item->kdkarya }}">
                                                        <div class="status-wrapper">
                                                            <input type="checkbox" name="status"
                                                                id="status_{{ $item->kdkarya }}" value="Ditampilkan"
                                                                onchange="this.form.submit()"
                                                                {{ $item->status === 'Ditampilkan' ? 'checked' : '' }}>
                                                            <label for="status_{{ $item->kdkarya }}"
                                                                class="status-button"></label>
                                                            <div class="status-text">
                                                                <span>{{ $item->status }}</span>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td>
                                                    <!-- Button trigger modal -->
                                                    <a href="{{ url('admin/karya/ubah/' . $item->kdkarya) }}"
                                                        class="btn btn-warning">
                                                        <i class="fas fa-pen"></i> Edit
                                                    </a>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#Hapus{{ $item->kdkarya }}">
                                                        <i class="fas fa-trash"> </i>Hapus
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.master.karya.hapus')

@endsection

@push('css')
    <style>
        .status-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Hide the default checkbox */
        .status-wrapper input[type="checkbox"] {
            display: none;
        }

        /* Custom switch style */
        .status-button {
            position: relative;
            display: inline-block;
            width: 50px;
            height: 26px;
            background-color: #ccc;
            border-radius: 50px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .status-button::after {
            content: "";
            position: absolute;
            top: 3px;
            left: 3px;
            width: 20px;
            height: 20px;
            background-color: white;
            border-radius: 50%;
            transition: transform 0.3s;
        }

        /* Checked state */
        .status-wrapper input[type="checkbox"]:checked+.status-button {
            background-color: #3314fe;
        }

        .status-wrapper input[type="checkbox"]:checked+.status-button::after {
            transform: translateX(24px);
        }

        .status-text span {
            font-size: 14px;
            font-weight: 500;
            color: #333;
        }
    </style>
@endpush

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            let timer;

            $('#search').on('input', function() {
                clearTimeout(timer);
                let query = $(this).val().trim();

                if (query === "") {
                    $('#karya-body').html(""); // Kosongkan jika tidak ada input
                    return;
                }

                timer = setTimeout(function() {
                    $.ajax({
                        url: "{{ route('admin.karya.cari') }}",
                        method: "GET",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            let rows = "";

                            if (data.length === 0) {
                                rows =
                                    `<tr><td colspan="8" class="text-center">Data tidak ditemukan.</td></tr>`;
                            } else {
                                $.each(data, function(index, item) {
                                    rows += `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.namaMhs}</td>
                                        <td>${item.kelas}</td>
                                        <td>${item.semester}</td>
                                        <td>${item.namaKarya}</td>
                                        <td>${item.deskripsi}</td>
                                        <td>
                                            <a href="${fileUrl}" target="_blank">
                                                ${item.judulFileAsli ? item.judulFileAsli : 'Unduh'}
                                            </a>
                                        </td>
                                        <td>${item.status}</td>
                                        <td>
                                            <!-- Button Edit -->
                                            <a href="admin/karya/ubah/${item.kdkarya}" class="btn btn-warning">
                                                <i class="fas fa-pen"></i> Edit
                                            </a>

                                            <!-- Button Hapus -->
                                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#Hapus${item.kdkarya}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>

                                            <!-- Modal Hapus -->
                                            <div class="modal fade" id="Hapus${item.kdkarya}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Hapus Data Karya</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action="admin/karya-hapus/${item.kdkarya}" method="POST">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <div class="modal-body">
                                                                <center>
                                                                    <h5 class="mt-2 mb-3">Apakah anda ingin menghapus data ini?</h5>
                                                                    <button type="submit" class="btn btn-danger ml-1">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Hapus</span>
                                                                    </button>
                                                                </center>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                                });
                            }

                            $('#karya-body').html(rows);
                        },
                        error: function() {
                            console.log("Gagal mengambil data!");
                        }
                    });
                }, 500);
            });
        });

        // MODAL LIHAT GAMBAR DAN VIDEO
        $(document).ready(function() {
            $('.view-media').on('click', function() {
                var src = $(this).data('src');
                var type = $(this).data('type');
                var content = '';

                if (type === 'video') {
                    content = '<video width="100%" controls><source src="' + src + '" type="video/' + src
                        .split('.').pop() + '">Browser Anda tidak mendukung tag video.</video>';
                } else if (type === 'image') {
                    content = '<img src="' + src + '" alt="Gambar" class="img-fluid">';
                } else {
                    content = '<p>Tidak ada media yang didukung</p>';
                }

                $('#mediaContent').html(content);
            });
        });
    </script>
@endpush


