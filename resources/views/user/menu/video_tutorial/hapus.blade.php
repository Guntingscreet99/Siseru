@if (auth()->id() === $video->user_id)
    <div class="modal fade" id="hapusModal{{ $video->kdvideo }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Konfirmasi Hapus video
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('user.video.hapus', $video->kdvideo) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <div class="modal-body text-center py-5">
                        <i class="fas fa-trash-alt text-danger mb-4" style="font-size: 4rem;"></i>
                        <h5>Yakin ingin menghapus karya ini?</h5>
                        <p class="text-muted">
                            <strong>"{{ $video->namavideo }}"</strong><br>
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
