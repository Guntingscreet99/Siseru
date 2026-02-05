@extends('bagian.user.rumah.home')
@section('judul', 'Testimoni Mahasiswa')
@section('isi')

    <div class="page-inner">
        <div class="testimoni-wrapper">

            <!-- Hero Header -->
            <div class="hero-section text-white text-center mt-4 py-5 mb-5 position-relative overflow-hidden rounded-5"
                style="max-width: 1400px; bborder-radius: 30px !important; background: #000;">
                <div class="bg-gradient"></div>
                <div class="container position-relative z-10 py-5">
                    <h1 class="display-4 fw-bold mb-3 animate__animated animate__fadeInDown">
                        Ruang Apresiasi & Testimoni
                    </h1>
                    <p class="lead mb-4 animate__animated animate__fadeInUp opacity-90">
                        Lihat bagaimana pengalaman mahasiswa dalam mengeksplorasi kreativitas dan mengembangkan karya seni
                        rupa melalui platform RUPAKU.
                    </p>

                    @auth
                        <a href="{{ route('user.testimoni.tampil') }}"
                            class="btn btn-light btn-lg shadow-lg px-5 py-3 floating-btn">
                            <i class="fas fa-comment-dots me-2"></i>
                            Berikan Testimoni
                        </a>
                    @endauth
                </div>
            </div>

            <div class="container pb-5">

                <!-- Grid Testimoni -->
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @forelse($testimonis as $testi)
                        <div class="col">
                            <div class="card shadow-sm p-3 h-100 hover-scale">
                                <div class="d-flex align-items-center mb-3">
                                    <img src="{{ $testi->user && $testi->user->dataDiri && $testi->user->dataDiri->fotoMhs
                                        ? Storage::url($testi->user->dataDiri->fotoMhs)
                                        : asset('landing/img/profil_dasar.png') }}"
                                        class="rounded-circle me-3" width="50" height="50" style="object-fit:cover;">

                                    <div>
                                        <strong>{{ $testi->user->nama_lengkap }}</strong><br>
                                        <small class="text-muted">{{ $testi->user->nim }}</small>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star {{ $i <= $testi->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                    @endfor
                                </div>
                                <p class="text-justify mb-0">{{ $testi->pesan }}</p>
                                @auth
                                    @if ($testi->user_id === auth()->id())
                                        <div class="d-flex justify-content-end gap-2 mt-3">
                                            <!-- EDIT -->
                                            <a href="{{ route('user.testimoni.edit-tampil', $testi->id) }}"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- HAPUS -->
                                            <form action="{{ route('user.testimoni.hapus', $testi->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus testimoni ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center py-5">
                            <p class="text-muted">Belum ada testimoni.</p>
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <style>
        .bg-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4') center/cover;
            opacity: 0.2;
        }

        .testimoni-wrapper {
            background: #f8fafc;
            min-height: 100vh;
        }

        .hero-section {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .card.hover-scale {
            border-radius: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card.hover-scale:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

@push('js')
    <script>
        // Inisialisasi Animate On Scroll (AOS)
        AOS.init({
            duration: 800,
            easing: 'slide',
            once: true,
        });
    </script>
@endpush
