@extends('bagian.admin.rumah.home')
@section('judul', 'Admin | Edit Data Forum')
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
                            {{-- <div class="form-group" style="display: flex; align-items: center;">
                                <input type="text" name="search" id="search" class="form-control"
                                    placeholder="Cari..." style="width: 70%;">
                                <button class="btn btn-info" type="button">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div> --}}
                        </div>
                        <form action="{{ url('admin/forum-edit/' . $forum->kdforum) }}" method="POST"
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
                                                <select name="kelas" id="kelas" class="form-control">
                                                    <option value="{{ $forum->kelas }}">-- Pilih Kelas --</option>
                                                    <option value="Kelas A"
                                                        {{ $forum->kelas == 'Kelas A' ? 'selected' : '' }}>Kelas A
                                                    </option>
                                                    <option value="Kelas B"
                                                        {{ $forum->kelas == 'Kelas B' ? 'selected' : '' }}>Kelas B
                                                    </option>
                                                    <option value="Kelas C"
                                                        {{ $forum->kelas == 'Kelas C' ? 'selected' : '' }}>Kelas C
                                                    </option>
                                                    <option value="Kelas D"
                                                        {{ $forum->kelas == 'Kelas D' ? 'selected' : '' }}>Kelas D
                                                    </option>
                                                    <option value="Kelas E"
                                                        {{ $forum->kelas == 'Kelas E' ? 'selected' : '' }}>Kelas E
                                                    </option>
                                                    <option value="Kelas F"
                                                        {{ $forum->kelas == 'Kelas F' ? 'selected' : '' }}>Kelas F
                                                    </option>
                                                    <option value="Kelas F"
                                                        {{ $forum->kelas == 'Kelas F' ? 'selected' : '' }}>Kelas F
                                                    </option>
                                                    <option value="Kelas G"
                                                        {{ $forum->kelas == 'Kelas G' ? 'selected' : '' }}>Kelas G
                                                    </option>
                                                    <option value="Kelas H"
                                                        {{ $forum->kelas == 'Kelas H' ? 'selected' : '' }}>Kelas H
                                                    </option>
                                                    <option value="Kelas I"
                                                        {{ $forum->kelas == 'Kelas I' ? 'selected' : '' }}>Kelas I
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="">Semester</label>
                                                <select name="semester" id="semester" class="form-control">
                                                    <option value="">-- Pilih Semester --</option>
                                                    <option value="Semester 1"
                                                        {{ $forum->semester == 'Semester 1' ? 'selected' : '' }}>Semester 1
                                                    </option>
                                                    <option value="Semester 2"
                                                        {{ $forum->semester == 'Semester 2' ? 'selected' : '' }}>Semester 2
                                                    </option>
                                                    <option value="Semester 3"
                                                        {{ $forum->semester == 'Semester 3' ? 'selected' : '' }}>Semester 3
                                                    </option>
                                                    <option value="Semester 4"
                                                        {{ $forum->semester == 'Semester 4' ? 'selected' : '' }}>Semester 4
                                                    </option>
                                                    <option value="Semester 5"
                                                        {{ $forum->semester == 'Semester 5' ? 'selected' : '' }}>Semester 5
                                                    </option>
                                                    <option value="Semester 6"
                                                        {{ $forum->semester == 'Semester 6' ? 'selected' : '' }}>Semester 6
                                                    </option>
                                                    <option value="Semester 7"
                                                        {{ $forum->semester == 'Semester 7' ? 'selected' : '' }}>Semester 7
                                                    </option>
                                                    <option value="Semester 8"
                                                        {{ $forum->semester == 'Semester 8' ? 'selected' : '' }}>Semester 8
                                                    </option>
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
