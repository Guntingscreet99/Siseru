@extends('bagian.admin.rumah.home')
@section('judul', 'Manajemen Testimoni')

@section('isi')
    <div class="container">
        <div class="card shadow">
            <div class="card-header">
                <h4>Daftar Testimoni Mahasiswa</h4>
            </div>

            <div class="card-body table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Mahasiswa</th>
                            <th>Rating</th>
                            <th>Pesan</th>
                            <th>Status</th>
                            <th width="220">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($testimonis as $t)
                            <tr>
                                <td>
                                    <strong>{{ $t->user->nama_lengkap }}</strong><br>
                                    <small>{{ $t->user->nim }}</small>
                                </td>

                                <td>
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star {{ $i <= $t->rating ? 'text-warning' : 'text-secondary' }}"></i>
                                    @endfor
                                </td>

                                <td>{{ $t->pesan }}</td>

                                <td>
                                    @if ($t->status == 1)
                                        <span class="badge bg-success">Tampil</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Menunggu</span>
                                    @endif
                                </td>

                                <td>
                                    @if ($t->status == 0)
                                        <form action="{{ route('admin.testimoni.approve', $t->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('PUT')
                                            <button class="btn btn-success btn-sm">Tampilkan</button>
                                        </form>
                                    @else
                                        <form action="{{ route('admin.testimoni.reject', $t->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('PUT')
                                            <button class="btn btn-warning btn-sm">Sembunyikan</button>
                                        </form>
                                    @endif

                                    <form action="{{ route('admin.testimoni.destroy', $t->id) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Hapus testimoni ini?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
