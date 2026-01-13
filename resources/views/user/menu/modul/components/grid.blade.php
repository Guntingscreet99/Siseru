@forelse ($modul as $item)
    @php
        $ext = $item->fileModul ? strtolower(pathinfo($item->fileModul, PATHINFO_EXTENSION)) : '';

        $fileUrl = $item->fileModul ? Storage::url($item->fileModul) : '';
    @endphp

    <div class="col animate__animated animate__fadeIn">
        <div class="book-card position-relative rounded-4 overflow-hidden shadow-lg h-100"
            style="height: 380px; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#detailModal"
            data-judul="{{ $item->judul }}" data-kelas="{{ $item->kelas?->nama_kelas ?? '-' }}"
            data-semester="{{ $item->semester?->nama_semester ?? '-' }}" data-topik="{{ $item->topik ?? '-' }}"
            data-tahun="{{ $item->tahun }}" data-file="{{ $fileUrl }}" data-type="{{ $ext }}">

            {{-- ================= Thumbnail / Preview ================= --}}
            @if ($item->fileModul)
                {{-- Image --}}
                @if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                    <img src="{{ $fileUrl }}" alt="{{ $item->judul }}" class="w-100 h-100"
                        style="object-fit: cover;">

                    {{-- Video --}}
                @elseif (in_array($ext, ['mp4', 'mkv', 'avi', 'webm']))
                    <div class="ratio ratio-1x1 position-relative bg-dark">
                        <video class="w-100 h-100" style="object-fit: cover;">
                            <source src="{{ $fileUrl }}">
                        </video>
                        <div class="play-icon">
                            <i class="fas fa-play-circle fa-4x"></i>
                        </div>
                    </div>

                    {{-- File non-media --}}
                @else
                    <div class="ratio ratio-1x1 d-flex align-items-center justify-content-center bg-dark text-white">
                        @switch($ext)
                            @case('pdf')
                                <i class="fas fa-file-pdf fa-6x text-danger opacity-75"></i>
                            @break

                            @case('doc')
                            @case('docx')
                                <i class="fas fa-file-word fa-6x text-primary opacity-75"></i>
                            @break

                            @case('xls')
                            @case('xlsx')
                                <i class="fas fa-file-excel fa-6x text-success opacity-75"></i>
                            @break

                            @case('ppt')
                            @case('pptx')
                                <i class="fas fa-file-powerpoint fa-6x text-warning opacity-75"></i>
                            @break

                            @default
                                <i class="fas fa-file-alt fa-6x text-secondary opacity-75"></i>
                        @endswitch
                    </div>
                @endif

                {{-- Tidak ada file --}}
            @else
                <div
                    class="ratio ratio-1x1 bg-gradient d-flex flex-column align-items-center justify-content-center text-white p-4">
                    <i class="fas fa-book-open fa-4x mb-3"></i>
                    <small class="text-center">
                        {{ Str::limit($item->judul, 30) }}
                    </small>
                </div>
            @endif

            {{-- ================= Overlay Informasi ================= --}}
            <div class="overlay">
                <div class="p-4 pt-5">
                    <h6 class="fw-bold text-black mb-2"
                        style="
                            display: -webkit-box;
                            -webkit-line-clamp: 2;
                            -webkit-box-orient: vertical;
                            overflow: hidden;
                        ">
                        {{ $item->judul }}
                        
                        {{ $item->topik ? ' - ' . $item->topik : '' }}
                    </h6>

                    <div class="d-flex align-items-center justify-content-between text-white small opacity-90">
                        <span>
                            {{ $item->kelas?->nama_kelas ?? 'Umum' }} • {{ $item->tahun }}
                        </span>

                        @if ($ext)
                            @switch($ext)
                                @case('pdf')
                                    <i class="fas fa-file-pdf text-danger"></i>
                                @break

                                @case('doc')
                                @case('docx')
                                    <i class="fas fa-file-word text-primary"></i>
                                @break

                                @case('xls')
                                @case('xlsx')
                                    <i class="fas fa-file-excel text-success"></i>
                                @break

                                @case('ppt')
                                @case('pptx')
                                    <i class="fas fa-file-powerpoint text-warning"></i>
                                @break

                                @default
                                    <i class="fas fa-file-alt text-white"></i>
                            @endswitch
                        @endif
                    </div>
                </div>
            </div>

            {{-- ================= Aksi Pemilik ================= --}}
            @auth
                @if (auth()->id() === $item->user_id)
                    <div class="position-absolute top-0 start-0 m-3 z-3">
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill shadow-sm small">
                            Milik Saya
                        </span>
                    </div>

                    <div class="action-buttons position-absolute top-0 end-0 m-3 z-3">
                        <a href="{{ route('user.modul.edit-tampil', $item->kdmodul) }}"
                            class="btn btn-light btn-sm rounded-circle shadow-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <button type="button" class="btn btn-danger btn-sm rounded-circle shadow-sm ms-2"
                            data-bs-toggle="modal" data-bs-target="#hapusModal"
                            data-url="{{ route('user.modul.hapus', $item->kdmodul) }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                @endif
            @endauth

        </div>
    </div>

    @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-book-reader fa-3x text-muted mb-4"></i>
            <h5 class="text-muted">
                {{ request('query') ? 'Modul tidak ditemukan' : 'Belum ada modul yang diunggah' }}
            </h5>
        </div>
    @endforelse

    <div class="d-flex justify-content-center mt-5">
        {{ $modul->appends(request()->query())->links() }}
    </div>
