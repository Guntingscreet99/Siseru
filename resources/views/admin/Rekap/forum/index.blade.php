@extends('bagian.admin.rumah.home')
@section('judul', 'Rekap Forum Diskusi')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>Rekap Forum: {{ $forum->topik }}</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a href="{{ url('admin/master/dataforum') }}" class="btn btn-primary mb-3">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>

                        @if ($forum->rekap)
                            <div class="border p-4 bg-light">
                                <pre class="text-dark" style="font-family: Consolas, monospace; white-space: pre-wrap;">
                                {{ $forum->rekap->isi_rekap }}
                            </pre>
                            </div>

                            <div class="mt-3 text-center">
                                <a href="{{ route('admin.forum.rekap.download', $forum->kdforum) }}"
                                    class="btn btn-success">
                                    <i class="fas fa-download"></i> Download Rekap (.txt)
                                </a>
                            </div>
                        @else
                            <div class="alert alert-info">
                                Rekap belum tersedia. Akan otomatis dibuat setelah forum berakhir.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
