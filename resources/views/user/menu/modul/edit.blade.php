@extends('bagian.user.rumah.home')
@section('judul', 'User | Edit Data Modul')
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
                                <a href="{{ url('user/menu/modul') }}" class="btn btn-primary">
                                    <i class="fas fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                        <form action="{{ url('user/modul-edit/' . $modul->kdmodul) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Judul</label>
                                                <input type="text" name="judul" id="judul" class="form-control"
                                                    value="{{ $modul->judul }}" placeholder="Masukkan Judul Modul" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kelas</label>
                                                <select name="id_kelas" id="id_kelas" class="form-control">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    @foreach ($kelas as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $modul->id_kelas == $item->id ? 'selected' : '' }}>
                                                            {{ $item->nama_kelas }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Semester</label>
                                                <select name="id_semester" id="id_semester" class="form-control">
                                                    <option value="">-- Pilih Semester --</option>
                                                    @foreach ($semester as $sem)
                                                        <option value="{{ $sem->id }}"
                                                            {{ $modul->id_semester == $sem->id ? 'selected' : '' }}>
                                                            {{ $sem->nama_semester }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Tahun</label>
                                                <input type="text" name="tahun" id="tahun" class="form-control"
                                                    value="{{ $modul->tahun }}" placeholder="Masukkan Tahun">
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">File Modul</label>
                                                <input type="file" name="fileModul" id="fileModul" class="form-control">

                                                @if ($modul->fileModul)
                                                    <p class="mt-2">
                                                        <li>
                                                            *File saat ini:
                                                            <a href="{{ Storage::url($modul->fileModul) }}"
                                                                target="_blank">
                                                                {{ $modul->judulFileAsli }}
                                                            </a>
                                                        </li>
                                                    </p>

                                                    <input type="checkbox" name="gunakan_file_lama" id="gunakan_file_lama"
                                                        class="form-check-input" checked>
                                                    <label class="form-check-label" for="gunakan_file_lama">Gunakan file
                                                        lama</label>
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Status</label>
                                                <select name="status" id="status" class="form-control">
                                                    <option value="">-- Pilih Status --</option>
                                                    <option value="Ditampilkan"
                                                        {{ $modul->status == 'Ditampilkan' ? 'selected' : '' }}>Ditampilkan
                                                    </option>
                                                    <option value="Tidak ditampilkan"
                                                        {{ $modul->status == 'Tidak ditampilkan' ? 'selected' : '' }}>Tidak
                                                        ditampilkan
                                                    </option>
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Topik</label>
                                                <textarea name="topik" id="topik" class="form-control" cols="10" rows="5">{{ $modul->topik }}</textarea>
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
