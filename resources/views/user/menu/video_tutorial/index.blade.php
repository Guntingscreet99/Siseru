{{-- resources/views/user/menu/video_tutorial/index.blade.php --}}

@extends('bagian.user.rumah.home')
@section('judul', 'Video Tutorial')
@section('isi')

    <div class="page-inner">
        <div class="galeri-wrapper">

            <!-- Hero Header -->
            <div class="hero-section text-white text-center mt-4 py-5 mb-5 position-relative overflow-hidden rounded-5"
                style="max-width: 1400px; border-radius: 30px !important; background: #000;">
                <div class="bg-gradient"></div>
                <div class="container position-relative z-10 py-5">
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
                        Video Pembelajaran
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp">
                        Koleksi video pembelajaran dari mahasiswa
                    </p>
                    @auth
                        <a href="{{ route('user.video.tampil') }}" class="btn btn-light btn-lg shadow-lg px-5 py-3 floating-btn">
                            <i class="fas fa-video me-2"></i> Unggah Video
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
                                    placeholder="Cari judul video, deskripsi..." autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Grid Video -->
                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="video-container">
                            @include('user.menu.video_tutorial.components.grid')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Video -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content overflow-hidden border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div id="videoPreview" class="bg-black">
                        <video controls class="w-100" style="max-height:80vh;">
                            <source src="" type="video/mp4">
                        </video>
                    </div>
                    <div class="p-4 bg-white">
                        <h3 id="modalJudul" class="fw-bold"></h3>
                        <p id="modalDeskripsi" class="text-muted"></p>
                        @if (auth()->check())
                            <a id="modalLink" href="" target="_blank" class="btn btn-outline-primary btn-sm">
                                Buka Link YouTube
                            </a>
                        @endif
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
            --gradient: linear-gradient(135deg, #667eea, #764ba2);
        }

        .galeri-wrapper {
            background: #f8fafc;
            min-height: 100vh
        }

        .hero-section {
            background: var(--gradient)
        }

        .bg-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1611224923853-80b023f02d71') center/cover;
            opacity: 0.2
        }

        .floating-add-btn {
            animation: pulse 2s infinite
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
            overflow: hidden
        }

        .gallery-card {
            height: 280px;
            border-radius: 1rem;
            overflow: hidden;
            cursor: pointer;
            transition: all .4s cubic-bezier(.175, .885, .32, 1.275);
            position: relative
        }

        .gallery-card:hover {
            transform: translateY(-12px) scale(1.04);
            box-shadow: 0 25px 50px rgba(0, 0, 0, .2) !important
        }

        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent 60%, rgba(0, 0, 0, .9));
            opacity: 0;
            transition: opacity .4s;
            display: flex;
            flex-direction: column;
            justify-content: end;
            padding: 20px
        }

        .gallery-card:hover .card-overlay {
            opacity: 1
        }

        .play-icon {
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4.5rem;
            opacity: 0;
            transition: opacity .3s
        }

        .gallery-card:hover .play-icon {
            opacity: .9
        }

        .action-buttons-hover {
            opacity: 0;
            transition: opacity .3s;
            z-index: 10
        }

        .gallery-card:hover .action-buttons-hover {
            opacity: 1
        }

        .bg-gradient-placeholder {
            background: var(--gradient)
        }

        .text-shadow {
            text-shadow: 0 2px 10px rgba(0, 0, 0, .8)
        }

        .line-clamp-2 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .karya-card {
            transition: all 0.3s ease;
        }

        .karya-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3) !important;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            let timer;

            function loadVideo(query = '', page = 1) {
                $('#video-container').html(
                    '<div class="col-12 text-center py-5"><div class="spinner-border text-primary" style="width:4rem;height:4rem;"></div></div>'
                );
                $.get("{{ route('user.video.cari') }}", {
                        query: query,
                        page: page
                    })
                    .done(data => $('#video-container').html(data));
            }
            $('#search').on('input', function() {
                clearTimeout(timer);
                let q = $(this).val().trim();
                if (q !== '' && q.length < 2) return;
                timer = setTimeout(() => loadVideo(q), q === '' ? 100 : 600);
            });
            $(document).on('click', '#video-container .pagination a', function(e) {
                e.preventDefault();
                let url = new URL(this.href);
                let page = url.searchParams.get('page') || 1;
                let q = $('#search').val().trim();
                loadVideo(q, page);
            });
            $('#detailModal').on('show.bs.modal', function(e) {
                let card = $(e.relatedTarget);
                let src = card.data('file') || card.data('link');
                let title = card.data('judul');
                let desc = card.data('deskripsi');
                let link = card.data('link');
                $('#modalJudul').text(title);
                $('#modalDeskripsi').text(desc || '-');
                $('#modalLink').attr('href', link);
                $('#videoPreview video source').attr('src', src);
                $('#videoPreview video')[0].load();
            });
        });
    </script>
@endpush
