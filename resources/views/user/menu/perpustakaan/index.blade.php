@extends('bagian.user.rumah.home')
@section('judul', 'Perpustakaan Digital')
@section('isi')

    <div class="page-inner">
        <div class="galeri-wrapper">

            <!-- HERO SECTION — RAPI, CANTIK, SERASI DENGAN GALERI KARYA -->
            <div class="hero-section text-white text-center mt-4 py-5 px-5 mb-5 position-relative overflow-hidden rounded-5"
                style="max-width: 1400px; border-radius: 30px !important; background: #000;">
                <div class="bg-gradient"></div>
                <!-- Foto perpustakaan asli -->
                {{-- <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&q=90') center/cover no-repeat;
                    background-attachment: fixed;
                    border-radius: 30px;">
                </div> --}}

                <!-- Overlay gelap elegan -->
                {{-- <div class="position-absolute top-0 start-0 w-100 h-100"
                    style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.8) 100%);
                    border-radius: 30px;">
                </div> --}}

                <div class="container position-relative z-10 py-5">
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
                        Perpustakaan Digital
                    </h1>
                    <p class="lead mb-2 fs-4 animate__animated animate__fadeInUp opacity-90">
                        Jelajahi koleksi buku, jurnal, artikel, dan modul pembelajaran dari civitas akademika
                    </p>

                    @auth
                        <a href="{{ route('user.perpus.tampil') }}" class="btn btn-light btn-lg shadow-lg px-5 py-3 floating-btn">
                            <i class="fas fa-book-medical me-2"></i>Unggah Koleksi Saya
                        </a>
                    @endauth
                </div>
            </div>

            <!-- SEARCH + GRID -->
            <div class="container pb-5">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8">
                        <div class="search-box shadow-lg rounded-pill overflow-hidden">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-search text-primary"></i>
                                </span>
                                <input type="text" id="search" class="form-control border-0 shadow-none fs-5"
                                    placeholder="Cari judul, kategori, topik, tahun..." autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GRID BUKU -->
                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4"
                            id="perpus-container">
                            @forelse($perpus as $item)
                                <div class="col">
                                    <div class="book-card position-relative rounded-4 overflow-hidden shadow-lg h-100"
                                        style="height: 380px; cursor: pointer;" data-bs-toggle="modal"
                                        data-bs-target="#detailModal" data-id="{{ $item->kdperpus }}"
                                        data-judul="{{ $item->judul }}"
                                        data-deskripsi="{{ $item->deskripsi ?? 'Tidak ada deskripsi' }}"
                                        data-kategori="{{ $item->kategori }}" data-topik="{{ $item->topik }}"
                                        data-tahun="{{ $item->tahun }}"
                                        data-file="{{ $item->filePerpus ? Storage::url($item->filePerpus) : '' }}"
                                        data-type="{{ $item->filePerpus ? strtolower(pathinfo($item->filePerpus, PATHINFO_EXTENSION)) : '' }}">

                                        <!-- Thumbnail -->
                                        @if ($item->cover)
                                            <img src="{{ Storage::url($item->cover) }}" class="w-100 h-100 object-fit-cover"
                                                alt="{{ $item->judul }}">
                                        @elseif($item->filePerpus)
                                            @php $ext = strtolower(pathinfo($item->filePerpus, PATHINFO_EXTENSION)) @endphp
                                            @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                <img src="{{ Storage::url($item->filePerpus) }}"
                                                    class="w-100 h-100 object-fit-cover" alt="{{ $item->judul }}">
                                            @elseif(in_array($ext, ['mp4', 'mkv', 'avi']))
                                                <div class="ratio ratio-1x1 position-relative bg-dark">
                                                    <video class="w-100 h-100 object-fit-cover">
                                                        <source src="{{ Storage::url($item->filePerpus) }}"
                                                            type="video/{{ $ext }}">
                                                    </video>
                                                    <div class="play-icon"><i class="fas fa-play-circle fa-4x"></i></div>
                                                </div>
                                            @elseif($ext === 'pdf')
                                                <div
                                                    class="ratio ratio-1x1 bg-danger d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-file-pdf fa-5x text-white opacity-75"></i>
                                                </div>
                                            @else
                                                <div
                                                    class="ratio ratio-1x1 bg-primary d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-file-alt fa-5x text-white opacity-75"></i>
                                                </div>
                                            @endif
                                        @else
                                            <div
                                                class="ratio ratio-1x1 bg-gradient d-flex flex-column align-items-center justify-content-center text-white p-4">
                                                <i class="fas fa-book-open fa-4x mb-3"></i>
                                                <small class="text-center">{{ Str::limit($item->judul, 30) }}</small>
                                            </div>
                                        @endif

                                        <!-- Overlay Info + Aksi -->
                                        <div class="overlay">
                                            <div class="overlay-content p-4 pt-5">
                                                <h6 class="text-white fw-bold mb-2"
                                                    style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                                    {{ $item->judul }}
                                                </h6>
                                                <div
                                                    class="d-flex align-items-center justify-content-between text-white-70 small mb-2">
                                                    <span>{{ $item->kategori }} • {{ $item->tahun }}</span>
                                                    @if ($item->filePerpus)
                                                        @php $ext = strtolower(pathinfo($item->filePerpus, PATHINFO_EXTENSION)) @endphp
                                                        @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                            <i class="fas fa-image"></i>
                                                        @elseif(in_array($ext, ['mp4', 'mkv', 'avi']))
                                                            <i class="fas fa-video text-danger"></i>
                                                        @elseif($ext === 'pdf')
                                                            <i class="fas fa-file-pdf text-danger"></i>
                                                        @else
                                                            <i class="fas fa-file-alt"></i>
                                                        @endif
                                                    @else
                                                        <i class="fas fa-book"></i>
                                                    @endif
                                                </div>
                                                @if ($item->deskripsi)
                                                    <p class="text-white-70 small mt-2 mb-0 opacity-90"
                                                        style="line-height: 1.4;">
                                                        {{ Str::limit(strip_tags($item->deskripsi), 70) }}
                                                    </p>
                                                @endif
                                            </div>

                                            @auth
                                                @if (auth()->id() === $item->user_id)
                                                    <div class="position-absolute top-0 start-0 m-3">
                                                        <span
                                                            class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">
                                                            Koleksi Saya
                                                        </span>
                                                    </div>
                                                    <div class="action-buttons">
                                                        <a href="{{ route('user.perpus.edit-tampil', $item->kdperpus) }}"
                                                            class="btn btn-light btn-sm rounded-circle shadow">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                            class="btn btn-danger btn-sm rounded-circle shadow ms-2"
                                                            data-bs-toggle="modal" data-bs-target="#hapusModal"
                                                            data-url="{{ url('user/perpus-hapus/' . $item->kdperpus) }}">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                @endif
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12 text-center py-5">
                                    <i class="fas fa-book-reader fa-6x text-muted mb-4"></i>
                                    <h4 class="text-muted">
                                        {{ request()->filled('query') ? 'Koleksi tidak ditemukan' : 'Belum ada koleksi yang diunggah' }}
                                    </h4>
                                    {{-- @auth
                            <a href="{{ route('user.perpus.tampil') }}" class="btn btn-primary btn-lg mt-4">
                                <i class="fas fa-plus me-2"></i>Unggah Koleksi Pertama
                            </a>
                        @endauth --}}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- MODAL DETAIL — PDF 100% MUNCUL! -->
                <div class="modal fade" id="detailModal" tabindex="-1">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content overflow-hidden border-0 rounded-4 shadow-lg">
                            <div class="modal-header border-0 pb-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body p-0">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div id="mediaPreview"
                                            class="bg-dark d-flex align-items-center justify-content-center"
                                            style="min-height: 70vh;">
                                            <div class="spinner-border text-light" style="width: 4rem; height: 4rem;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 bg-white p-4 p-lg-5 overflow-auto">
                                        <h3 class="fw-bold mb-3" id="modalJudul">-</h3>
                                        <div class="mb-4">
                                            <small class="text-muted text-uppercase fw-bold">Informasi Koleksi</small>
                                            <hr class="my-2">
                                            <p><strong>Kategori:</strong> <span id="modalKategori">-</span></p>
                                            <p><strong>Tema:</strong> <span id="modalTopik">-</span></p>
                                            <p><strong>Tahun:</strong> <span id="modalTahun">-</span></p>
                                        </div>
                                        <div class="mb-4">
                                            <small class="text-muted text-uppercase fw-bold">Deskripsi</small>
                                            <hr class="my-2">
                                            <p id="modalDeskripsi" class="text-justify text-muted">-</p>
                                        </div>
                                        <a href="#" id="downloadBtn" class="btn btn-primary btn-lg w-100 shadow">
                                            <i class="fas fa-download me-2"></i> Unduh File
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL HAPUS -->
                <div class="modal fade" id="hapusModal" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content rounded-4 shadow-lg border-0">
                            <div class="modal-header border-0">
                                <h5 class="modal-title text-danger">Hapus Koleksi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form id="formHapus" method="POST">
                                @csrf @method('DELETE')
                                <div class="modal-body text-center py-5">
                                    <i class="fas fa-trash-alt text-danger fa-4x mb-4"></i>
                                    <h5>Yakin ingin menghapus koleksi ini?</h5>
                                    <p class="text-muted">Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
                                </div>
                                <div class="modal-footer border-0 justify-content-center">
                                    <button type="button" class="btn btn-secondary px-4"
                                        data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-danger px-4">Ya, Hapus Permanen</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    @endsection

    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <style>
            <style> :root {
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
                background: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?auto=format&fit=crop&q=90') center/cover;
                opacity: 0.2;
            }

            .floating-btn {
                animation: float 3s ease-in-out infinite;
                transition: all 0.3s;
            }

            .floating-btn:hover {
                transform: translateY(-8px) !important;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3) !important;
            }

            @keyframes float {
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

            .book-card:hover {
                transform: translateY(-12px) scale(1.03);
                box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25) !important;
            }

            .overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(transparent 40%, rgba(0, 0, 0, 0.95));
                opacity: 0;
                transition: opacity 0.4s;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
            }

            .book-card:hover .overlay {
                opacity: 1;
            }

            .overlay-content {
                background: linear-gradient(transparent, rgba(0, 0, 0, 0.9));
                border-radius: 0 0 16px 16px;
            }

            .action-buttons {
                position: absolute;
                top: 12px;
                right: 12px;
                opacity: 0;
                transition: opacity 0.3s;
                z-index: 10;
            }

            .book-card:hover .action-buttons {
                opacity: 1;
            }

            .play-icon {
                position: absolute;
                inset: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                opacity: 0;
                transition: opacity 0.3s;
            }

            .book-card:hover .play-icon {
                opacity: 0.9;
            }

            .bg-gradient {
                background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 50%, #3b82f6 100%);
            }
        </style>
    @endpush

    @push('js')
        <script>
            // Modal Hapus
            document.getElementById('hapusModal')?.addEventListener('show.bs.modal', e => {
                document.getElementById('formHapus').action = e.relatedTarget.dataset.url;
            });

            // MODAL DETAIL — PDF 100% MUNCUL PAKAI IFRAME!
            document.getElementById('detailModal')?.addEventListener('show.bs.modal', function(e) {
                const card = e.relatedTarget;
                const file = card.dataset.file;
                const type = card.dataset.type.toLowerCase();

                // Isi informasi
                this.querySelector('#modalJudul').textContent = card.dataset.judul;
                this.querySelector('#modalKategori').textContent = card.dataset.kategori;
                this.querySelector('#modalTopik').textContent = card.dataset.topik || '-';
                this.querySelector('#modalTahun').textContent = card.dataset.tahun;
                this.querySelector('#modalDeskripsi').textContent = card.dataset.deskripsi || 'Tidak ada deskripsi.';
                this.querySelector('#downloadBtn').href = file;

                // Tampilkan preview
                let content = '';
                if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(type)) {
                    content = `<img src="${file}" class="img-fluid rounded shadow" style="max-height: 70vh;">`;
                } else if (['mp4', 'mkv', 'avi'].includes(type)) {
                    content = `<video controls class="w-100 rounded shadow" style="max-height: 70vh;">
                         <source src="${file}" type="video/${type}">Browser tidak mendukung.
                       </video>`;
                } else if (type === 'pdf') {
                    content = `<iframe src="${file}#toolbar=1&navpanes=1&scrollbar=1&view=FitH"
                             class="w-100 rounded shadow" style="height: 70vh; border: none;"></iframe>`;
                } else {
                    content = `<div class="d-flex flex-column align-items-center justify-content-center h-100 text-light">
                <i class="fas fa-file-alt fa-5x mb-3"></i>
                <p>Preview tidak tersedia</p>
                <a href="${file}" class="btn btn-light">Unduh File</a>
            </div>`;
                }
                this.querySelector('#mediaPreview').innerHTML = content;
            });
        </script>
    @endpush
