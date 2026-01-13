{{-- Modal hapus --}}
@foreach ($rangking as $item)
    <div class="modal fade" id="Hapus{{ $item->kdperingkat }}" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Hapus Data Karya</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('admin/peringkat-hapus/' . $item->kdperingkat) }}"method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body">
                        <center>
                            <h5 class="mt-2 mb-3">Apakah anda ingin menghapus data ini?</h5>
                            <button type="submit" class="btn btn-danger ml-1">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                <span class="d-none d-sm-block">Hapus</span>
                            </button>
                        </center>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
