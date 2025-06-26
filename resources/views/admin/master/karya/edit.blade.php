@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Edit Data Karya')
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
                                <a href="{{ url('admin/master/datakarya') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                            {{-- <div class="form-group" style="display: flex; align-items: center;">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Cari..." style="width: 70%;">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> --}}
                        </div>
                        <form action="{{ url('admin/karya-edit/' . $karya->kdkarya) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        {{-- <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kelas</label>
                                                <select name="kelas" id="kelas" class="form-control">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    <option value="Kelas A"
                                                        {{ $zoom->kelas == 'Kelas A' ? 'selected' : '' }}>Kelas A
                                                    </option>
                                                    <option value="Kelas B"
                                                        {{ $zoom->kelas == 'Kelas B' ? 'selected' : '' }}>Kelas B
                                                    </option>
                                                    <option value="Kelas C"
                                                        {{ $zoom->kelas == 'Kelas C' ? 'selected' : '' }}>Kelas C
                                                    </option>
                                                    <option value="Kelas D"
                                                        {{ $zoom->kelas == 'Kelas D' ? 'selected' : '' }}>Kelas D
                                                    </option>
                                                    <option value="Kelas E"
                                                        {{ $zoom->kelas == 'Kelas E' ? 'selected' : '' }}>Kelas E
                                                    </option>
                                                    <option value="Kelas F"
                                                        {{ $zoom->kelas == 'Kelas F' ? 'selected' : '' }}>Kelas F
                                                    </option>
                                                    <option value="Kelas G"
                                                        {{ $zoom->kelas == 'Kelas G' ? 'selected' : '' }}>Kelas G
                                                    </option>
                                                    <option value="Kelas H"
                                                        {{ $zoom->kelas == 'Kelas H' ? 'selected' : '' }}>Kelas H
                                                    </option>
                                                    <option value="Kelas I"
                                                        {{ $zoom->kelas == 'Kelas I' ? 'selected' : '' }}>Kelas I
                                                    </option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Nama Karya</label>
                                                <input type="text" name="nama" id="nama" class="form-control"
                                                    value="{{ $karya->nama }}" placeholder="Masukkan Nama Karya" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Deskripsi Karya</label>
                                                <textarea name="deskripsi" id="deskripsi" class="form-control" cols="10" rows="5">{{ old('deskripsi', $karya->deskripsi) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="fileKarya">File Karya</label>
                                                <input type="file" name="fileKarya" id="fileKarya" class="form-control">

                                                @if ($karya->fileKarya)
                                                    <p class="mt-2">
                                                        <li>
                                                            *File saat ini
                                                            <a href="{{ Storage::url($karya->fileKarya) }}" target="_blank">
                                                                {{ $karya->judulFileAsli }}
                                                            </a>
                                                        </li>
                                                    </p>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="gunakan_file_lama"
                                                            id="gunakan_file_lama" class="form-check-input" checked>
                                                        <label class="form-check-label" for="gunakan_file_lama">
                                                            Gunakan file lama
                                                        </label>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Ditampilkan"
                                                        {{ $karya->status == 'Ditampilkan' ? 'selected' : '' }}>Ditampilkan
                                                    </option>
                                                    <option value="Tidak Ditampilkan"
                                                        {{ $karya->status == 'Tidak Ditampilkan' ? 'selected' : '' }}>Tidak
                                                        Ditampilkan
                                                    </option>
                                                </select>
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
