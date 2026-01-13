@extends('bagian.user.rumah.home')
@section('judul', 'User | Tambah Data Zoom')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="mb-3" style="display: flex; justify-content: space-between">
                            <div class="form-group">
                                <a href="{{ url('user/menu/zoom') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ url('user/zoom/tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kelas</label>
                                                <select name="id_kelas" id="id_kelas" class="form-control" required>
                                                    <option value="">-- Pilih Kelas --</option>
                                                    @if (optional($kelas)->isNotEmpty())
                                                        @foreach ($kelas as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ old('id_kelas') == $item->id ? 'selected' : '' }}>
                                                                {{ $item->nama_kelas }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada kelas tersedia</option>
                                                    @endif
                                                </select>
                                                @error('id_kelas')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Link Zoom</label>
                                                <input type="text" name="linkZoom" id="linkZoom" class="form-control"
                                                    placeholder="Masukkan Link Zoom" value="{{ old('linkZoom') }}">
                                                @error('linkZoom')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Link Webinar</label>
                                                <input type="text" name="linkWebinar" id="linkWebinar"
                                                    class="form-control" placeholder="Masukkan Link Webinar"
                                                    value="{{ old('linkWebinar') }}">
                                                @error('linkWebinar')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <input type="hidden" name="judulFileAsli">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="status" class="form-control" required>
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Ditampilkan"
                                                        {{ old('status') == 'Ditampilkan' ? 'selected' : '' }}>Ditampilkan
                                                    </option>
                                                    <option value="Tidak Ditampilkan"
                                                        {{ old('status') == 'Tidak Ditampilkan' ? 'selected' : '' }}>Tidak
                                                        Ditampilkan</option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </table>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" style="margin-right: 10px">Tutup</button> --}}
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
