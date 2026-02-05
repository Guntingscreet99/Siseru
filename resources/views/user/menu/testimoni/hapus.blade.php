@extends('bagian.user.rumah.home')
@section('judul', 'Hapus Testimoni')
@section('isi')

    <div class="page-inner">
        <div class="container py-5">
            <div class="card shadow-sm p-4 text-center">
                <h3 class="mb-4 text-danger">Hapus Testimoni</h3>
                <p>Apakah Anda yakin ingin menghapus testimoni berikut?</p>

                <div class="d-flex align-items-center justify-content-center mb-3">
                    <img src="{{ $testimoni->fotoMhs ? asset('storage/' . $testimoni->fotoMhs) : asset('default-avatar.png') }}"
                        class="rounded-circle me-3" width="50" height="50" style="object-fit:cover;">
                    <div>
                        <strong>{{ $testimoni->user->nama_lengkap }}</strong><br>
                        <small class="text-muted">{{ $testimoni->user->nim }}</small>
                    </div>
                </div>

                <p class="fst-italic">"{{ $testimoni->pesan }}"</p>

                <form action="{{ route('user.testimoni.destroy', $testimoni->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger me-2">
                        <i class="fas fa-trash me-1"></i> Hapus
                    </button>
                    <a href="{{ route('user.testimoni.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>

@endsection
