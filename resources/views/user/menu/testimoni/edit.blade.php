@extends('bagian.user.rumah.home')
@section('judul', 'User | Edit Testimoni')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">

                <div class="card-header bg-gradient-primary text-dark text-center">
                    <h3 class="mb-0">
                        <i class="fas fa-edit me-2"></i>
                        Edit Testimoni
                    </h3>
                </div>

                <div class="card-body">

                    <div class="mb-3 d-flex justify-content-between">
                        <a href="{{ route('user.testimoni.index') }}" class="btn btn-primary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>

                    <!-- FORM UPDATE -->
                    <form action="{{ route('user.testimoni.edit', $testimoni->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <!-- RATING -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="d-block fw-semibold mb-2">Rating</label>

                                    <div class="d-flex gap-3">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rating"
                                                    id="rating{{ $i }}" value="{{ $i }}"
                                                    {{ old('rating', $testimoni->rating) == $i ? 'checked' : '' }} required>
                                                <label class="form-check-label" for="rating{{ $i }}">
                                                    {{ $i }}
                                                </label>
                                            </div>
                                        @endfor
                                    </div>

                                    @error('rating')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- PESAN -->
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="pesan" class="fw-semibold">Pesan / Testimoni</label>
                                    <textarea name="pesan" id="pesan" class="form-control" rows="4" required>{{ old('pesan', $testimoni->pesan) }}</textarea>

                                    @error('pesan')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>

                            <!-- STATUS -->
                            <input type="hidden" name="status" value="{{ $testimoni->status }}">

                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-success btn-lg px-5 shadow">
                                <i class="fas fa-save me-2"></i> Update Testimoni
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
