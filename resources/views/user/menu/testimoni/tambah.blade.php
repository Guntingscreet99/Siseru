@extends('bagian.user.rumah.home')
@section('judul', 'User | Tambah Testimoni')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-dark text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-plus-circle me-2"></i>
                        Tambah Tesetimoni
                    </h3>
                </div>

                <div class="card">
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <div class="mb-3" style="display: flex; justify-content: space-between">
                            <div class="form-group">
                                <a href="{{ url('user/menu/testimoni') }}" class="btn btn-primary">
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
                        <form action="{{ url('user/testimoni/tambah') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="row">

                                    <!-- Rating -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="d-block">Rating</label>

                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="rating1" value="1" required>
                                                    <label class="form-check-label" for="rating1">1</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="rating2" value="2">
                                                    <label class="form-check-label" for="rating2">2</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="rating3" value="3">
                                                    <label class="form-check-label" for="rating3">3</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="rating4" value="4">
                                                    <label class="form-check-label" for="rating4">4</label>
                                                </div>

                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="rating5" value="5">
                                                    <label class="form-check-label" for="rating5">5</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Pesan -->
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="pesan">Pesan / Testimoni</label>
                                            <textarea name="pesan" id="pesan" class="form-control" rows="4" placeholder="Tuliskan kesan dan saran Anda"
                                                required></textarea>
                                        </div>
                                    </div>

                                    <!-- Status (default false / 0) -->
                                    <input type="hidden" name="status" value="0">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary btn-lg px-5 shadow">
                                    <i class="fas fa-save me-2"></i> Simpan Perpustakaan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
