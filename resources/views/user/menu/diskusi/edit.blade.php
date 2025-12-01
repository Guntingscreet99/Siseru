@extends('bagian.user.rumah.home')
@section('judul', 'User | Edit Data Forum')
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
                                <a href="{{ url('user/menu/forum') }}" class="btn btn-primary">
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
                        <form action="{{ url('user/forum-edit/' . $forum->kdforum) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <table class="table table-responsive table-striped table-bordered text-center"
                                    style="white-space: nowrap; overflow-x: auto; width: 100%">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Akun</label>
                                                <input type="text" name="akun" id="akun" class="form-control"
                                                    value="{{ $forum->akun }}" placeholder="Masukkan Akun" required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Kelas</label>
                                                <select name="id_kelas" id="id_kelas" class="form-control">
                                                    <option value="">-- Pilih Kelas --</option>
                                                    @foreach ($kelas as $item)
                                                        <option value="{{ $item->id }}"
                                                            {{ $forum->id_kelas == $item->id ? 'selected' : '' }}>
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
                                                            {{ $forum->id_semester == $sem->id ? 'selected' : '' }}>
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
                                                    value="{{ $forum->tahun }}" placeholder="Masukkan Tahun">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">Topik</label>
                                                <textarea name="topik" id="topik" class="form-control" cols="10" rows="5">{{ $forum->topik }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">File Forum</label>
                                                <input type="file" name="fileForum" id="fileForum" class="form-control">

                                                @if ($forum->fileForum)
                                                    <p class="mt-2">
                                                        <li>
                                                            *File saat ini:
                                                            <a href="{{ Storage::url($forum->fileForum) }}"
                                                                target="_blank">
                                                                {{ $forum->judulFileAsli }}
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
