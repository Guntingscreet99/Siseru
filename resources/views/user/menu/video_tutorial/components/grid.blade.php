@forelse($video as $item)
    <div class="col-lg-4 col-md-6 mb-4 animate__animated animate__fadeIn"
        style="animation-delay: {{ $loop->index * 0.1 }}s">

        <div class="karya-card position-relative overflow-hidden rounded-4 shadow-sm h-100 bg-dark text-white
                    transition-all duration-300 hover:shadow-xl hover:-translate-y-2 cursor-pointer"
            data-bs-toggle="modal" data-bs-target="#detailModal" data-id="{{ $item->kdvideo }}"
            data-judul="{{ $item->judul }}" data-deskripsi="{{ $item->deskripsi ?? '' }}" data-link="{{ $item->link }}"
            data-file="{{ $item->fileVideo ? asset($item->fileVideo) : '' }}">

            <!-- Thumbnail Video -->
            <div class="ratio ratio-16x9 overflow-hidden">
                @if ($item->fileVideo)
                    <video class="w-100 h-100 object-fit-cover transition-all duration-500 hover:scale-110"
                        preload="metadata" muted playsinline>
                        <source src="{{ asset($item->fileVideo) }}#t=0.5" type="video/mp4">
                    </video>
                    <div
                        class="play-icon position-absolute top-50 start-50 translate-middle z-3
                                opacity-80 hover:opacity-100 transition-all">
                        <i class="fas fa-play-circle fa-4x text-white drop-shadow-lg"></i>
                    </div>
                @else
                    <div
                        class="bg-gradient-to-br from-gray-800 to-gray-900 d-flex align-items-center justify-content-center">
                        <i class="fas fa-video fa-4x text-white opacity-30"></i>
                    </div>
                @endif
            </div>

            <!-- Overlay Bawah (Judul + Tanggal) -->
            <div
                class="position-absolute bottom-0 start-0 w-100 p-4 bg-gradient-to-t from-black/90 via-black/50 to-transparent">
                <h5 class="mb-1 fw-bold text-shadow-lg line-clamp-2">
                    {{ Str::limit($item->judul, 50) }}
                </h5>
                <small class="text-white-50">
                    <i class="far fa-calendar-alt me-1"></i>
                    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
                </small>
            </div>

            <!-- Badge "Video Saya" -->
            @auth
                @if (auth()->id() === $item->user_id)
                    <div class="position-absolute top-0 start-0 m-3 z-3">
                        <span class="badge bg-success text-white px-3 py-2 rounded-pill shadow-lg text-sm font-medium">
                            <i class="fas fa-star me-1"></i> Video Saya
                        </span>
                    </div>
                @endif
            @endauth

            <!-- Tombol Aksi (Edit & Hapus) - hanya pemilik, muncul saat hover -->
            @auth
                @if (auth()->id() === $item->user_id)
                    <div
                        class="position-absolute top-0 end-0 m-3 d-flex gap-2 z-3 opacity-0 action-buttons
                                transition-opacity duration-300">
                        <a href="{{ url('user/video/ubah', $item->kdvideo) }}"
                            class="btn btn-sm btn-light rounded-circle shadow-lg hover:bg-gray-200
                                  d-flex align-items-center justify-content-center"
                            style="width:40px;height:40px;">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <button type="button"
                            class="btn btn-sm btn-danger rounded-circle shadow-lg hover:bg-red-600
                                       d-flex align-items-center justify-content-center"
                            data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item->kdvideo }}"
                            style="width:40px;height:40px;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endif
            @endauth

            <!-- Hover Effect untuk Action Buttons -->
            <style>
                .karya-card:hover .action-buttons {
                    opacity: 1 !important;
                }

                .karya-card:hover .play-icon {
                    transform: translate(-50%, -50%) scale(1.2);
                }
            </style>
        </div>
    </div>

    <!-- Modal Hapus (hanya milik sendiri) -->
    @auth
        @if (auth()->id() === $item->user_id)
            @include('user.menu.video_tutorial.hapus', ['video' => $item])
        @endif
    @endauth

@empty
    <div class="col-12 text-center py-5">
        <i class="fas fa-video-slash fa-3x text-muted mb-4"></i>
        <h5 class="text-muted">
            {{ request()->filled('query') ? 'Video tidak ditemukan' : 'Belum ada video yang diunggah' }}
        </h5>
    </div>
@endforelse

<!-- Pagination -->
@if ($video->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $video->links() }}
    </div>
@endif
