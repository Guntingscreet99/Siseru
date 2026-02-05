@foreach ($rekap as $item)
    <div class="modal fade" id="hapuskarya{{ $item->kdkarya }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-trash"></i> Hapus Karya
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body text-center">
                    <p class="fw-bold">
                        Yakin ingin menghapus karya berikut?
                    </p>

                    <table class="table table-sm table-borderless">
                        <tr>
                            <th width="120">Mahasiswa</th>
                            <td>{{ $item->namaMhs }}</td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>{{ $item->nim }}</td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td>{{ $item->namaKarya }}</td>
                        </tr>
                    </table>

                    <span class="text-danger">
                        Data yang dihapus tidak dapat dikembalikan.
                    </span>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Batal
                    </button>

                    <form action="{{ route('admin.rekap.karya.destroy', $item->kdkarya) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">
                            Ya, Hapus
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endforeach
