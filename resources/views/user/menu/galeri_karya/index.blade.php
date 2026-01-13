@extends('bagian.user.rumah.home')
@section('judul', 'Galeri Karya Mahasiswa')
@section('isi')

    <div class="page-inner">
        <div class="galeri-wrapper">

            <!-- Hero Header -->
            <div class="hero-section text-white text-center mt-4 py-5 mb-5 position-relative overflow-hidden rounded-5"
                style="max-width: 1400px; border-radius: 30px !important; background: #000;">
                <div class="bg-gradient"></div>
                <div class="container position-relative z-10 py-5">
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
                        Galeri Karya Kreatif
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp opacity-90">
                        Temukan karya-karya luar biasa dari mahasiswa kita
                    </p>

                    @auth
                        <a href="{{ route('user.galeri.tampil') }}" class="btn btn-light btn-lg shadow-lg px-5 py-3 floating-btn">
                            <i class="fas fa-palette me-2"></i> Unggah Karya
                        </a>
                    @endauth
                </div>
            </div>

            <div class="container pb-5">

                <!-- Search Bar -->
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8">
                        <div class="search-container shadow-lg">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-transparent border-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" id="search"
                                    class="form-control form-control-lg border-0 shadow-none"
                                    placeholder="Cari nama mahasiswa, judul karya, kelas..." autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid Galeri -->
                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="galeri-container">
                            @include('user.menu.galeri_karya.components.grid')
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content overflow-hidden border-0 rounded-4 shadow-lg"
                style="background: rgba(255,255,255,0.95); backdrop-filter: blur(10px);">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-8">
                            <div id="mediaPreview"
                                class="text-center bg-dark d-flex align-items-center justify-content-center"
                                style="min-height: 70vh;">
                                <div class="spinner-border text-light" style="width:4rem;height:4rem;"></div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-white p-4 p-lg-5">
                            <h3 class="fw-bold mb-3" id="modalKarya"></h3>
                            <div class="d-flex align-items-center mb-4">
                                <img id="modalFoto" src="" class="rounded-circle me-3"
                                    style="width:50px;height:50px;object-fit:cover;border:2px solid #6366f1;">
                                <div>
                                    <h6 class="mb-0" id="modalNama"></h6>
                                    <small class="text-muted" id="modalNim"></small>
                                </div>
                            </div>
                            <div class="mb-4">
                                <small class="text-muted text-uppercase fw-bold">Detail</small>
                                <hr class="my-2">
                                <p class="mb-1"><strong>Kelas:</strong> <span id="modalKelas"></span></p>
                                <p class="mb-1"><strong>Semester:</strong> <span id="modalSemester"></span></p>
                            </div>
                            <div>
                                <small class="text-muted text-uppercase fw-bold">Deskripsi</small>
                                <hr class="my-2">
                                <p id="modalDeskripsi" class="text-justify"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        :root {
            --primary: #6366f1;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .galeri-wrapper {
            background: #f8fafc;
            min-height: 100vh;
        }

        .hero-section {
            background: var(--gradient);
        }

        .bg-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1513364776144-60967b0f800f?auto=format&fit=crop&q=80') center/cover;
            opacity: 0.2;
        }

        .floating-add-btn {
            animation: pulse 2s infinite;
        }

        .floating-btn:hover {
            transform: translateY(-8px) !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3) !important;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, .7)
            }

            70% {
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0)
            }

            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0)
            }
        }

        .search-container {
            background: white;
            border-radius: 50px;
            overflow: hidden;
        }

        .gallery-card {
            height: 320px;
            border-radius: 1rem;
            overflow: hidden;
            cursor: pointer;
            transition: all .4s cubic-bezier(.175, .885, .32, 1.275);
            position: relative;
        }

        .gallery-card:hover {
            transform: translateY(-12px) scale(1.04);
            box-shadow: 0 25px 50px rgba(0, 0, 0, .2) !important;
        }

        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent 50%, rgba(0, 0, 0, .8));
            opacity: 0;
            transition: opacity .4s;
            display: flex;
            flex-direction: column;
            justify-content: end;
            padding: 20px;
        }

        .gallery-card:hover .card-overlay {
            opacity: 1;
        }

        .play-icon {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
            opacity: 0;
            transition: opacity .3s;
        }

        .gallery-card:hover .play-icon {
            opacity: .8;
        }

        /* PERBAIKAN INI YANG BIKIN TOMBOL KEMBALI MUNCUL */
        .action-buttons-hover {
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 20;
        }

        .gallery-card:hover .action-buttons-hover {
            opacity: 1 !important;
        }

        .text-shadow {
            text-shadow: 0 2px 10px rgba(0, 0, 0, .8);
        }

        .bg-gradient-placeholder {
            background: var(--gradient);
        }

        .avatar-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            let timer;

            // Live Search + Pagination
            function loadGaleri(query = '', page = 1) {
                $('#galeri-container').html(
                    '<div class="col-12 text-center py-5"><div class="spinner-border text-primary" style="width:4rem;height:4rem;"></div></div>'
                );

                $.get("{{ route('user.galeri.cari') }}", {
                        query: query,
                        page: page
                    })
                    .done(function(data) {
                        $('#galeri-container').html(data);
                    })
                    .fail(function() {
                        $('#galeri-container').html(
                            '<div class="col-12 text-danger text-center py-5">Gagal memuat data</div>');
                    });
            }

            $('#search').on('input', function() {
                clearTimeout(timer);
                let q = $(this).val().trim();
                if (q !== '' && q.length < 2) return;
                timer = setTimeout(() => loadGaleri(q), q === '' ? 100 : 600);
            });

            // Pagination klik tetap AJAX
            $(document).on('click', '#galeri-container .pagination a', function(e) {
                e.preventDefault();
                let url = new URL($(this).attr('href'));
                let page = url.searchParams.get('page') || 1;
                let q = $('#search').val().trim();
                loadGaleri(q, page);
            });

            // Modal Detail
            $('#detailModal').on('show.bs.modal', function(e) {
                let card = $(e.relatedTarget);
                let src = card.data('file');
                let type = card.data('type');
                let title = card.data('karya');
                let foto = card.data('foto');

                $('#modalFoto').attr('src', foto);
                $('#modalKarya').text(title);
                $('#modalNama').text(card.data('nama'));
                $('#modalNim').text(card.data('nim'));
                $('#modalKelas').text(card.data('kelas'));
                $('#modalSemester').text(card.data('semester'));
                $('#modalDeskripsi').text(card.data('deskripsi') || '-');

                let content =
                    '<div class="spinner-border text-light" style="width:4rem;height:4rem;"></div>';
                if (type === 'video') {
                    content =
                        `<video controls class="w-100" style="max-height:70vh"><source src="${src}" type="video/mp4"></video>`;
                } else if (type === 'image') {
                    content = `<img src="${src}" class="img-fluid rounded" style="max-height:70vh;">`;
                }
                $('#mediaPreview').html(content);
            });
        });
    </script>
@endpush
