{{-- Di dalam file index.blade.php atau components/grid.blade.php --}}
{{-- <div class="col-md-4 mb-4">
    <div class="card h-100 shadow-sm">
        <!-- isi card karya kamu -->

        <div class="card-body">
            <h5 class="card-title">{{ $karya->namaKarya }}</h5>
            <p class="card-text text-muted small">
                Oleh: {{ $karya->user?->identitas?->nama_lengkap ?? ($karya->namaMhs ?? 'Anonim') }}
            </p>
            <!-- tombol lain -->
        </div>

        <div class="card-footer bg-white border-0">
            @if (auth()->id() === $karya->user_id)
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                    data-bs-target="#hapusModal{{ $karya->kdkarya }}">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            @endif
        </div>
    </div>
</div> --}}

{{-- MODAL HAPUS — HANYA SATU PER KARYA, DI DALAM LOOP --}}
@if (auth()->id() === $karya->user_id)
    <div class="modal fade" id="hapusModal{{ $karya->kdkarya }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Konfirmasi Hapus Karya
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('user.galeri.hapus', $karya->kdkarya) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body text-center py-5">
                        <i class="fas fa-trash-alt text-danger mb-4" style="font-size: 4rem;"></i>
                        <h5>Yakin ingin menghapus karya ini?</h5>
                        <p class="text-muted">
                            <strong>"{{ $karya->namaKarya }}"</strong><br>
                            Tindakan ini <span class="text-danger">tidak dapat dibatalkan</span>.
                        </p>
                    </div>

                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-trash me-2"></i> Ya, Hapus Permanen
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endif
