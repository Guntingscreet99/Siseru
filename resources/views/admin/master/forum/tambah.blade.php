@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Tambah Data Forum')
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
                                <a href="{{ url('admin/master/dataforum') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ url('admin/forum/tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Username</label>
                                                <input type="text" name="akun" id="akun" class="form-control"
                                                    placeholder="Masukkan Akun Pembelajaran"
                                                    value="{{ old('akun') }}"required>
                                                @error('akun')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
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
                                                <label for="">Semester</label>
                                                <select name="id_semester" id="id_semester" class="form-control" required>
                                                    <option value="">-- Pilih Semester --</option>
                                                    @if (optional($semester)->isNotEmpty())
                                                        @foreach ($semester as $sem)
                                                            <option value="{{ $sem->id }}"
                                                                {{ old('id_semester') == $sem->id ? 'selected' : '' }}>
                                                                {{ $sem->nama_semester }}
                                                            </option>
                                                        @endforeach
                                                    @else
                                                        <option value="">Tidak ada semester tersedia</option>
                                                    @endif
                                                </select>
                                                @error('id_semester')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tahun</label>
                                                <input type="text" name="tahun" id="tahun" class="form-control"
                                                    placeholder="Masukkan Semester Anda" value="{{ old('tahun') }}"
                                                    required>
                                                @error('tahun')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Topik</label>
                                                <textarea name="topik" id="topik" class="form-control" cols="10" rows="5">{{ old('topik') }}</textarea>
                                                @error('topik')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">File Forum</label>
                                                <input type="file" name="fileForum" id="fileForum" class="form-control">
                                                @error('fileForum')
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
