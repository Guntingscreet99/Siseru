@extends('bagian.user.rumah.home')
@section('judul', 'Galeri Karya Mahasiswa')
@section('isi')

    <div class= "container">
        <div class="page-inner">
            <div class="galeri-wrapper">
                <!-- Hero Header -->
                <div class="hero-section text-white text-center mt-4 py-5 mb-5
              position-relative overflow-hidden
              rounded-5"
                    style="border-radius: 30px !important;">
                    <div class="bg-gradient"></div>
                    <div class="container position-relative z-10">
                        <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
                            Galeri Karya Kreatif
                        </h1>
                        <p class="lead mb-4 animate__animated animate__fadeInUp">
                            Temukan karya-karya luar biasa dari mahasiswa kita
                        </p>

                        @auth
                            <a href="{{ route('user.galeri.tampil') }}" class="btn btn-light btn-lg shadow-lg floating-add-btn">
                                <i class="fas fa-plus-circle me-2"></i>
                                Unggah Karya Saya
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="container pb-5">
                    <!-- Search Bar Premium -->
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

                    <!-- Galeri Grid -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="galeri-container">
                                @forelse($karya as $item)
                                    <div class="col animate__animated animate__fadeIn"
                                        style="animation-delay: {{ $loop->index * 0.1 }}s">
                                        <div class="gallery-card position-relative overflow-hidden rounded-4 shadow-sm"
                                            data-bs-toggle="modal" data-bs-target="#detailModal"
                                            data-id="{{ $item->kdkarya }}" data-nama="{{ $item->namaMhs }}"
                                            data-nim="{{ $item->user->nim ?? '—' }}"
                                            data-kelas="{{ $item->kelas->nama_kelas ?? '-' }}"
                                            data-semester="{{ $item->semester->nama_semester ?? '-' }}"
                                            data-karya="{{ $item->namaKarya }}"
                                            data-deskripsi="{{ $item->deskripsi ?? '' }}"
                                            data-file="{{ $item->fileKarya ? Storage::url($item->fileKarya) : '' }}"
                                            data-type="{{ $item->fileKarya ? (in_array(strtolower(pathinfo($item->fileKarya, PATHINFO_EXTENSION)), ['mp4', 'mkv', 'avi']) ? 'video' : 'image') : '' }}">

                                            <!-- Thumbnail -->
                                            @if ($item->fileKarya)
                                                @php $ext = strtolower(pathinfo($item->fileKarya, PATHINFO_EXTENSION)); @endphp
                                                @if (in_array($ext, ['mp4', 'mkv', 'avi']))
                                                    <div class="ratio ratio-1x1">
                                                        <video class="w-100 h-100 object-fit-cover">
                                                            <source src="{{ Storage::url($item->fileKarya) }}"
                                                                type="video/{{ $ext }}">
                                                        </video>
                                                        <div class="play-icon">
                                                            <i class="fas fa-play-circle"></i>
                                                        </div>
                                                    </div>
                                                @else
                                                    <img src="{{ Storage::url($item->fileKarya) }}"
                                                        class="w-100 h-100 object-fit-cover" alt="{{ $item->namaKarya }}">
                                                @endif
                                            @else
                                                <div
                                                    class="ratio ratio-1x1 bg-gradient-placeholder d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-image fa-3x text-white opacity-50"></i>
                                                </div>
                                            @endif

                                            <!-- Overlay -->
                                            <div class="card-overlay">
                                                <div class="overlay-content">
                                                    <h5 class="mb-1 text-white text-shadow">
                                                        {{ Str::limit($item->namaKarya, 30) }}
                                                    </h5>
                                                    <p class="mb-small text-white-50 text-shadow mb-0">
                                                        {{ $item->namaMhs }}
                                                    </p>
                                                </div>

                                                <!-- Badge Karya Saya -->
                                                @auth
                                                    @if (auth()->id() === $item->user_id)
                                                        <span
                                                            class="badge bg-warning text-dark position-absolute top-0 end-0 m-3 px-3 py-2 rounded-pill shadow-sm">
                                                            <i class="fas fa-star me-1"></i> Karya Saya
                                                        </span>

                                                        <!-- Action Buttons (hanya muncul saat hover & milik sendiri) -->
                                                        <div class="action-buttons">
                                                            <a href="{{ route('user.galeri.edit', $item->kdkarya) }}"
                                                                class="btn btn-sm btn-light rounded-circle shadow">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button class="btn btn-sm btn-danger rounded-circle shadow ms-2"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#hapusModal{{ $item->kdkarya }}">
                                                                <i class="fas fa-trash"></i>
                                                            </button>
                                                        </div>
                                                    @endif
                                                @endauth
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus (hanya untuk karya sendiri) -->
                                    @auth
                                        @if (auth()->id() === $item->user_id)
                                            @include('user.menu.galeri_karya.hapus', ['karya' => $item])
                                        @endif
                                    @endauth

                                @empty
                                    <div class="col-12 text-center py-5">
                                        <i class="fas fa-images fa-5x text-muted mb-4"></i>
                                        <h4 class="text-muted">Belum ada karya yang diunggah</h4>
                                        @auth
                                            <a href="{{ route('user.galeri.tampil') }}" class="btn btn-primary mt-3">
                                                Jadilah yang pertama mengunggah!
                                            </a>
                                        @endauth
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Detail Super Premium -->
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
                                    <div id="mediaPreview" class="text-center bg-dark"
                                        style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
                                        <div class="spinner-border text-light" role="status"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4 bg-white p-4 p-lg-5">
                                    <h3 class="fw-bold mb-3" id="modalKarya"></h3>
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="avatar-placeholder me-3">
                                            <i class="fas fa-user-circle fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0" id="modalNama"></h6>
                                            <small class="text-muted" id="modalNim"></small>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <small class="text-muted text-uppercase fw-bold">Detail</small>
                                        <hr class="my-2">
                                        <p><strong>Kelas:</strong> <span id="modalKelas"></span></p>
                                        <p><strong>Semester:</strong> <span id="modalSemester"></span></p>
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
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        :root {
            --primary: #6366f1;
            --dark: #0f172a;
            --gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .galeri-wrapper {
            background: #f8fafc;
            min-height: 100vh;
        }

        .hero-section {
            background: var(--gradient);
            border-radius: 0 0 50px 50px;
            position: relative;
        }

        .bg-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&q=80') center/cover;
            opacity: 0.2;
        }

        .floating-add-btn {
            animation: pulse 2s infinite;
            box-shadow: 0 10px 30px rgba(99, 102, 241, 0.4) !important;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(99, 102, 241, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }

        .search-container {
            background: white;
            border-radius: 50px;
            overflow: hidden;
        }

        .gallery-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            border: none !important;
            height: 320px;
        }

        .gallery-card:hover {
            transform: translateY(0);
        }

        .gallery-card:hover {
            transform: translateY(-15px) scale(1.03);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15) !important;
        }

        .card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(transparent 50%, rgba(0, 0, 0, 0.8));
            opacity: 0;
            transition: opacity 0.4s;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
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
            transition: opacity 0.3s;
        }

        .gallery-card:hover .play-icon {
            opacity: 0.8;
        }

        .action-buttons {
            position: absolute;
            top: 15px;
            right: 15px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .gallery-card:hover .action-buttons {
            opacity: 1;
        }

        .text-shadow {
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.8);
        }

        .bg-gradient-placeholder {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .avatar-placeholder {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: var(--gradient);
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            // Live Search dengan Skeleton
            let timer;
            $('#search').on('input', function() {
                clearTimeout(timer);
                let query = $(this).val().trim();

                if (query.length < 2 && query !== '') return;

                timer = setTimeout(() => {
                    $('#galeri-container').html(`
                        <div class="col-12 text-center py-5">
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;"></div>
                        </div>
                    `);

                    $.ajax({
                        url: "{{ route('user.galeri.cari') }}",
                        data: {
                            query: query
                        },
                        success: function(data) {
                            $('#galeri-container').html(data);
                        }
                    });
                }, query === '' ? 100 : 500);
            });

            // Modal Detail
            $('#detailModal').on('show.bs.modal', function(e) {
                let card = $(e.relatedTarget);
                let src = card.data('file');
                let type = card.data('type');
                let title = card.data('karya');

                $('#modalKarya').text(title);
                $('#modalNama').text(card.data('nama'));
                $('#modalNim').text(card.data('nim'));
                $('#modalKelas').text(card.data('kelas'));
                $('#modalSemester').text(card.data('semester'));
                $('#modalDeskripsi').text(card.data('deskripsi'));

                let content =
                    '<div class="spinner-border text-light" style="width: 4rem; height: 4rem;"></div>';
                if (type === 'video') {
                    content = `<video controls class="w-100" style="max-height: 70vh;">
                          <source src="${src}" type="video/mp4">
                       </video>`;
                } else if (type === 'image') {
                    content = `<img src="${src}" class="img-fluid rounded" style="max-height: 70vh;">`;
                } else {
                    content = '<p class="text-light fs-3">No media available</p>';
                }
                $('#mediaPreview').html(content);
            });
        });
    </script>
@endpush
