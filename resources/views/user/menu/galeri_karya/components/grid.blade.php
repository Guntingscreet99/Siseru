{{-- resources/views/user/menu/galeri_karya/components/grid.blade.php --}}

@forelse($karya as $item)
    <div class="col animate__animated animate__fadeIn" style="animation-delay: {{ $loop->index * 0.1 }}s">
        <div class="gallery-card position-relative overflow-hidden rounded-4 shadow-sm h-100" data-bs-toggle="modal"
            data-bs-target="#detailModal" data-id="{{ $item->kdkarya }}" data-nama="{{ $item->namaMhs }}"
            data-nim="{{ $item->user->nim ?? '—' }}" data-kelas="{{ $item->kelas->nama_kelas ?? '-' }}"
            data-semester="{{ $item->semester->nama_semester ?? '-' }}" data-karya="{{ $item->namaKarya }}"
            data-deskripsi="{{ $item->deskripsi ?? '' }}"
            data-file="{{ $item->fileKarya ? Storage::url($item->fileKarya) : '' }}"
            data-type="{{ $item->fileKarya ? (in_array(strtolower(pathinfo($item->fileKarya, PATHINFO_EXTENSION)), ['mp4', 'mkv', 'avi']) ? 'video' : 'image') : '' }}"
            data-foto="{{ $item->user && $item->user->datadiri && $item->user->datadiri->fotoMhs
                ? Storage::url($item->user->datadiri->fotoMhs)
                : asset('landing/img/profil_dasar.png') }}">

            {{-- Thumbnail --}}
            @if ($item->fileKarya)
                @php $ext = strtolower(pathinfo($item->fileKarya, PATHINFO_EXTENSION)) @endphp
                @if (in_array($ext, ['mp4', 'mkv', 'avi']))
                    <div class="ratio ratio-1x1">
                        <video class="w-100 h-100 object-fit-cover" preload="metadata">
                            <source src="{{ Storage::url($item->fileKarya) }}#t=0.5" type="video/{{ $ext }}">
                        </video>
                        <div class="play-icon"><i class="fas fa-play-circle"></i></div>
                    </div>
                @else
                    <img src="{{ Storage::url($item->fileKarya) }}" class="w-100 h-100 object-fit-cover" loading="lazy"
                        alt="{{ $item->namaKarya }}">
                @endif
            @else
                <div class="ratio ratio-1x1 bg-gradient-placeholder d-flex align-items-center justify-content-center">
                    <i class="fas fa-image fa-3x text-white opacity-50"></i>
                </div>
            @endif

            {{-- Overlay Judul --}}
            <div class="card-overlay">
                <div class="px-3 pb-3">
                    <h5 class="mb-1 text-white text-shadow">{{ Str::limit($item->namaKarya, 35) }}</h5>
                    <p class="mb-0 text-white-50 small text-shadow">{{ $item->namaMhs }}</p>
                </div>
            </div>

            {{-- Badge & Tombol Aksi --}}
            @auth
                @if (auth()->id() === $item->user_id)
                    <div class="position-absolute top-0 start-0 m-3">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm">
                            <i class="fas fa-star me-1"></i> Karya Saya
                        </span>
                    </div>

                    <div class="position-absolute top-0 end-0 m-3 d-flex gap-2 opacity-0 action-buttons-hover">
                        <a href="{{ route('user.galeri.edit-tampil', $item->kdkarya) }}"
                            class="btn btn-sm btn-light rounded-circle shadow-lg d-flex align-items-center justify-content-center"
                            style="width:38px;height:38px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button"
                            class="btn btn-sm btn-danger rounded-circle shadow-lg d-flex align-items-center justify-content-center"
                            data-bs-toggle="modal" data-bs-target="#hapusModal{{ $item->kdkarya }}"
                            style="width:38px;height:38px;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endif
            @endauth
        </div>
    </div>

    {{-- Modal Hapus --}}
    @auth
        @if (auth()->id() === $item->user_id)
            @include('user.menu.galeri_karya.hapus', ['karya' => $item])
        @endif
    @endauth
@empty
    <div class="col-md-12 text-center py-5">
        <i class="fas fa-images fa-3x text-muted mb-4"></i>
        <h5 class="text-muted">
            {{ request()->filled('query') ? 'Tidak ditemukan' : 'Belum ada karya yang diunggah' }}
        </h5>
    </div>
@endforelse
