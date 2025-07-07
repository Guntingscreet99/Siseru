@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Tambah Data Karya')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3" style="display: flex; justify-content: space-between">
                            <div class="form-group">
                                <a href="{{ route('admin.master.karya') }}" class="btn btn-primary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ route('admin.karya.tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Nama Mahasiswa</label>
                                                <input type="text" name="namaMhs" id="namaMhs" class="form-control"
                                                    placeholder="Masukkan Nama Mahasiswa" value="{{ old('namaMhs') }}"
                                                    required>
                                                @error('namaMhs')
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
                                                <label for="">Nama Karya</label>
                                                <input type="text" name="namaKarya" id="namaKarya" class="form-control"
                                                    placeholder="Masukkan Nama Karya" value="{{ old('namaKarya') }}"
                                                    required>
                                                @error('namaKarya')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="fileKarya">File Karya</label>
                                                <input type="file" name="fileKarya" class="form-control">
                                                @error('fileKarya')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status Karya</label>
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
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Deskripsi Karya</label>
                                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="10" rows="5">{{ old('deskripsi') }}</textarea>
                                                @error('deskripsi')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
