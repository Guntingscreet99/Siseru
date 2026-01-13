{{-- Modal Hapus — HANYA 1 MODAL, PAKAI data-* untuk isi dinamis --}}
<div class="modal fade" id="hapusModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="hapusModalLabel">Hapus Koleksi Perpustakaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formHapus" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body text-center">
                    <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                    <h5>Apakah Anda yakin ingin menghapus koleksi ini?</h5>
                    <p class="text-muted">Tindakan ini <strong>tidak dapat dibatalkan</strong>.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus Permanen</button>
                </div>
            </form>
        </div>
    </div>
</div>
