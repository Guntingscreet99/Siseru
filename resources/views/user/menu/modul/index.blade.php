@extends('bagian.user.rumah.home')
@section('judul', 'Modul Pembelajaran')
@section('isi')

    <div class="page-inner">
        <div class="galeri-wrapper">

            <!-- Hero Header -->
            <div class="hero-section text-white text-center mt-4 py-5 mb-5 position-relative overflow-hidden rounded-5"
                style="max-width: 1400px; border-radius: 30px !important; background: #000;">
                <div class="bg-gradient"></div>
                <div class="container position-relative z-10 py-5">
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
                        Modul Pembelajaran
                    </h1>
                    <p class="lead mb-4 fs-4 animate__animated animate__fadeInUp opacity-90">
                        Koleksi modul, materi kuliah, dan sumber belajar dari seluruh kelas & semester
                    </p>

                    @auth
                        <a href="{{ route('user.modul.tampil') }}" class="btn btn-light btn-lg shadow-lg px-5 py-3 floating-btn">
                            <i class="fas fa-book-open me-2"></i> Unggah Modul
                        </a>
                    @endauth
                </div>
            </div>

            <!-- SEARCH -->
            <div class="container pb-5">
                <div class="row justify-content-center mb-5">
                    <div class="col-lg-8">
                        <div class="search-box shadow-lg rounded-pill overflow-hidden">
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white border-0">
                                    <i class="fas fa-search text-primary"></i>
                                </span>
                                <input type="text" id="search" class="form-control border-0 shadow-none fs-5"
                                    placeholder="Cari judul, kelas, semester, topik, tahun..." autocomplete="off"
                                    value="{{ request('query') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- GRID -->
                <div class="card">
                    <div class="card-body">
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="galeri-container">
                            @include('user.menu.modul.components.grid')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL DETAIL & HAPUS (sama seperti perpus) -->
    <div class="modal fade" id="detailModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content overflow-hidden border-0 rounded-4 shadow-lg">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-0">
                    <div class="row g-0">
                        <div class="col-lg-8">
                            <div id="mediaPreview" class="bg-dark d-flex align-items-center justify-content-center"
                                style="min-height: 70vh;">
                                <div class="spinner-border text-light" style="width: 4rem; height: 4rem;"></div>
                            </div>
                        </div>
                        <div class="col-lg-4 bg-white p-4 p-lg-5 overflow-auto">
                            <h3 class="fw-bold mb-3" id="modalJudul">-</h3>
                            <div class="mb-4">
                                <small class="text-muted text-uppercase fw-bold">Informasi Modul</small>
                                <hr class="my-2">
                                <p><strong>Kelas:</strong> <span id="modalKelas">-</span></p>
                                <p><strong>Semester:</strong> <span id="modalSemester">-</span></p>
                                <p><strong>Topik:</strong> <span id="modalTopik">-</span></p>
                                <p><strong>Tahun:</strong> <span id="modalTahun">-</span></p>
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

    <div class="modal fade" id="hapusModal" data-bs-backdrop="static">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow-lg border-0">
                <div class="modal-header border-0">
                    <h5 class="modal-title text-danger">Hapus Modul</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formHapus" method="POST">
                    @csrf @method('DELETE')
                    <div class="modal-body text-center py-5">
                        <i class="fas fa-trash-alt text-danger fa-4x mb-4"></i>
                        <h5>Yakin ingin menghapus modul ini?</h5>
                        <p class="text-muted">Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger px-4">Ya, Hapus</button>
                    </div>
                </form>
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
            background: url('https://images.unsplash.com/photo-1517842645767-c639042777db?auto=format&fit=crop&q=80') center/cover;
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
        // Live Search
        let timeout;
        $('#search').on('input', function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                const query = $(this).val();
                $.get('{{ route('user.modul.index') }}', {
                    query: query
                }, function(data) {
                    $('#modul-container').html(data);
                });
            }, 400);
        });

        // Modal Hapus
        document.getElementById('hapusModal')?.addEventListener('show.bs.modal', e => {
            document.getElementById('formHapus').action = e.relatedTarget.dataset.url;
        });

        // Modal Detail (sama seperti perpus)
        document.getElementById('detailModal')?.addEventListener('show.bs.modal', function(e) {
            const btn = e.relatedTarget;
            const file = btn.dataset.file;
            const type = btn.dataset.type.toLowerCase();
            const judul = btn.dataset.judul;

            this.querySelector('#modalJudul').textContent = judul;
            this.querySelector('#modalKelas').textContent = btn.dataset.kelas;
            this.querySelector('#modalSemester').textContent = btn.dataset.semester;
            this.querySelector('#modalTopik').textContent = btn.dataset.topik || '-';
            this.querySelector('#modalTahun').textContent = btn.dataset.tahun;
            this.querySelector('#downloadBtn').href = file;

            let content = '';
            if (['jpg', 'jpeg', 'png', 'gif', 'webp'].includes(type)) {
                content = `<img src="${file}" class="img-fluid rounded shadow" style="max-height:70vh;">`;
            } else if (['mp4', 'mkv', 'avi', 'webm'].includes(type)) {
                content =
                    `<video controls class="w-100 rounded shadow" style="max-height:70vh;"><source src="${file}" type="video/${type}"></video>`;
            } else if (type === 'pdf') {
                content =
                    `<iframe src="${file}#toolbar=1&navpanes=1&scrollbar=1&view=FitH" class="w-100 rounded shadow" style="height:70vh;border:none;"></iframe>`;
            } else {
                let icon = 'fa-file-alt text-secondary';
                if (['doc', 'docx'].includes(type)) icon = 'fa-file-word text-primary';
                if (['xls', 'xlsx'].includes(type)) icon = 'fa-file-excel text-success';
                if (['ppt', 'pptx'].includes(type)) icon = 'fa-file-powerpoint text-warning';

                content = `<div class="d-flex flex-column align-items-center justify-content-center h-100 text-light">
                <i class="fas ${icon} fa-8x mb-4"></i>
                <h4>Preview tidak tersedia</h4>
                <p>File <strong>${type.toUpperCase()}</strong> tidak dapat ditampilkan</p>
                <a href="${file}" class="btn btn-light btn-lg" download><i class="fas fa-download me-2"></i>Unduh ${judul}</a>
            </div>`;
            }
            this.querySelector('#mediaPreview').innerHTML = content;
        });
    </script>
@endpush
