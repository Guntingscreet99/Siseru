@extends('bagian.user.rumah.home')
@section('judul', 'User | Menu Forum')
@section('isi')

    <div class="container">
        <div class="page-inner">
            <div class="guru">
                <div class="judul">
                    <h1>@yield('judul')</h1>
                </div>
                <hr>

                <!-- DAFTAR FORUM DISKUSI -->
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="fw-bold text-muted">Daftar Forum Diskusi</h5>
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center" style="white-space: nowrap">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Topik</th>
                                        <th>Kelas</th>
                                        <th>Semester</th>
                                        <th>File/Dokumen</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($forum as $f)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $f->created_at->format('d/m/Y') }}</td>
                                            <td>{{ $f->created_at->format('H:i') }} Wib</td>
                                            <td class="text-start fw-bold">
                                                {{ $f->topik }}
                                                @if ($f->waktu_selesai && $f->waktu_selesai->isPast())
                                                    <span class="badge bg-success ms-2">Selesai</span>
                                                @else
                                                    <span class="badge bg-warning text-dark ms-2">Berlangsung</span>
                                                @endif
                                            </td>
                                            <td>{{ $f->kelas->nama_kelas ?? '-' }}</td>
                                            <td>{{ $f->semester->nama_semester ?? '-' }}</td>
                                            <td>
                                                @if ($f->fileForum)
                                                    <a href="{{ asset('storage/' . $f->fileForum) }}" target="_blank"
                                                        class="btn btn-sm btn-outline-success">
                                                        <i class="fas fa-file-download me-1"></i> Download
                                                    </a>
                                                @else
                                                    <span class="text-muted">Tidak ada file</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($f->waktu_selesai && $f->waktu_selesai->isPast())
                                                    <span class="badge bg-success fw-bold">
                                                        <i class="fas fa-check-circle"></i> Selesai</span>
                                                @else
                                                    <span class="text-primary fw-bold">Aktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <!-- Tombol Buka Diskusi (selalu ada) -->
                                                <button
                                                    class="btn btn-info btn-buka-diskusi shadow-sm d-flex align-items-center justify-content-center gap-2 mb-2"
                                                    data-kdforum="{{ $f->kdforum }}" data-topik="{{ $f->topik }}"
                                                    data-waktuselesai="{{ $f->waktu_selesai ? $f->waktu_selesai->timestamp : '' }}">
                                                    <i class="fas fa-comments fa-lg"></i>
                                                    <span>Diskusi</span>
                                                </button>

                                                <!-- Tombol Lihat Rekap (hanya muncul kalau sudah lewat waktu selesai) -->
                                                {{-- @if ($f->waktu_selesai && $f->waktu_selesai->isPast())
                                                    <button
                                                        class="btn btn-success btn-lihat-rekap shadow-sm d-flex align-items-center justify-content-center gap-2"
                                                        data-kdforum="{{ $f->kdforum }}"
                                                        data-topik="{{ $f->topik }}">
                                                        <i class="fas fa-file-alt"></i>
                                                        <span>Lihat Rekap</span>
                                                    </button>
                                                @endif --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="9" class="text-center py-4 text-muted">
                                                Belum ada forum diskusi untuk kelas Anda.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- AREA CHAT DISKUSI (tetap sama, hanya sedikit dipercantik) -->
                <div id="area-diskusi" class="card shadow-lg border-0 rounded-4 mt-4" style="display:none;">
                    <div
                        class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                        <h4 class="mb-0 fw-bold">
                            <span id="judul-diskusi">Diskusi: -</span>
                        </h4>
                        <button type="button" class="btn-close btn-close-white" id="tutup-diskusi"
                            aria-label="Tutup"></button>
                    </div>

                    <div class="card-body p-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                        <div id="info-waktu" class="mb-4"></div>

                        <div id="daftar-pesan" class="border rounded-3 bg-white shadow-sm mb-4"
                            style="height: 500px; overflow-y: auto; padding: 20px; font-size: 15px;">
                            <div class="text-center text-muted py-5">
                                <div class="spinner-border text-primary" role="status"></div>
                                <div class="mt-2">Memuat pesan...</div>
                            </div>
                        </div>

                        <div id="form-container">
                            <form id="form-kirim-pesan" class="d-flex gap-2">
                                @csrf
                                <input type="hidden" id="kdforum" name="kdforum">
                                <textarea class="form-control shadow-sm" name="pesan" rows="3" placeholder="Ketik pesan Anda di sini..."
                                    required maxlength="1000" style="resize: none;"></textarea>
                                <button type="submit" class="btn btn-success btn-lg px-4 shadow">Kirim</button>
                            </form>
                            <small class="text-muted d-block mt-1">Maksimal 1000 karakter</small>
                        </div>

                        <div id="diskusi-tutup" class="alert alert-danger text-center mt-4 rounded-3 shadow"
                            style="display:none;">
                            <h5 class="fw-bold">Diskusi Telah Ditutup Otomatis</h5>
                            <p class="mb-3">Waktu diskusi hanya 1 jam setelah forum dibuka.</p>
                            {{-- <button type="button" class="btn btn-success btn-lg px-5" id="btn-lihat-rekap-dari-chat">
                                Lihat Rekap Diskusi
                            </button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let kdforumAktif = null;
        let timerInterval = null;
        let waktuSelesai = null;

        $(document).ready(function() {

            // 1. Buka Diskusi
            $('.btn-buka-diskusi').on('click', function() {
                kdforumAktif = $(this).data('kdforum');
                const topik = $(this).data('topik');
                waktuSelesai = $(this).data('waktuselesai') ? new Date($(this).data('waktuselesai') *
                    1000) : null;

                $('#kdforum').val(kdforumAktif);
                $('#judul-diskusi').text('Diskusi: ' + topik);
                $('#area-diskusi').slideDown(600);
                loadPesan(kdforumAktif);
                startTimer();

                $('html, body').animate({
                    scrollTop: $("#area-diskusi").offset().top - 80
                }, 600);
            });

            // 2. Tutup Area Diskusi
            $('#tutup-diskusi').on('click', function() {
                $('#area-diskusi').slideUp(500);
                kdforumAktif = null;
                clearInterval(timerInterval);
            });

            // 3. Load Pesan
            function loadPesan(kdforum) {
                $.get(`/diskusi/${kdforum}/pesan`)
                    .done(function(data) {
                        $('#daftar-pesan').html(data ||
                            '<div class="text-center text-muted">Belum ada pesan. Jadilah yang pertama!</div>'
                        );
                        scrollToBottom();
                    })
                    .fail(function() {
                        $('#daftar-pesan').html('<div class="alert alert-danger">Gagal memuat pesan.</div>');
                    });
            }

            // 4. Timer
            function startTimer() {
                $('#info-waktu').empty();
                $('#form-container').show();
                $('#diskusi-tutup').hide();

                if (!waktuSelesai) {
                    $('#info-waktu').html(
                        '<div class="alert alert-secondary">Tidak ada batasan waktu untuk diskusi ini.</div>');
                    return;
                }

                timerInterval = setInterval(function() {
                    const selisih = waktuSelesai - new Date();
                    if (selisih <= 0) {
                        clearInterval(timerInterval);
                        $('#info-waktu').html(
                            '<div class="alert alert-danger"><strong>Waktu Habis!</strong> Diskusi ditutup otomatis.</div>'
                        );
                        $('#form-container').hide();
                        $('#diskusi-tutup').show();
                        loadPesan(kdforumAktif);
                        return;
                    }
                    const menit = Math.floor(selisih / 60000);
                    const detik = Math.floor((selisih % 60000) / 1000);
                    $('#info-waktu').html(`
                    <div class="alert alert-warning border-0 shadow-sm">
                        <strong>Waktu Tersisa: ${menit} menit ${detik} detik</strong>
                    </div>
                `);
                }, 1000);
            }

            // 5. Kirim Pesan
            $('#form-kirim-pesan').on('submit', function(e) {
                e.preventDefault();
                const pesan = $('textarea[name=pesan]').val().trim();
                if (!pesan) return;

                $.ajax({
                    url: '/diskusi/kirim',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        kdforum: kdforumAktif,
                        pesan: pesan
                    },
                    success: function() {
                        $('textarea[name=pesan]').val('');
                        loadPesan(kdforumAktif);
                    },
                    error: function(xhr) {
                        Swal.fire('Gagal', xhr.responseJSON?.message ||
                            'Tidak dapat mengirim pesan', 'error');
                    }
                });
            });

            // 6. LIHAT REKAP dari tombol di daftar forum
            $(document).on('click', '.btn-lihat-rekap', function() {
                const kdforum = $(this).data('kdforum');
                const topik = $(this).data('topik');

                Swal.fire({
                    title: 'Memuat Rekap...',
                    html: '<div class="spinner-border text-primary"></div>',
                    allowOutsideClick: false,
                    showConfirmButton: false
                });

                $.get(`/diskusi/rekap/${kdforum}`)
                    .done(function(text) {
                        Swal.fire({
                            title: `Rekap Diskusi: ${topik}`,
                            html: `<pre style="text-align:left; max-height:70vh; overflow:auto; background:#f8f9fa; padding:20px; border-radius:10px; font-family:'Courier New',monospace; white-space:pre-wrap;">${text.replace(/\n/g, '<br>')}</pre>`,
                            width: '960px',
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    })
                    .fail(function() {
                        Swal.fire('Info', 'Rekap diskusi belum tersedia.', 'info');
                    });
            });

            // 7. LIHAT REKAP dari dalam chat (setelah waktu habis)
            $(document).on('click', '#btn-lihat-rekap-dari-chat', function() {
                $('.btn-lihat-rekap[data-kdforum="' + kdforumAktif + '"]').trigger('click');
            });

            function scrollToBottom() {
                const el = $('#daftar-pesan');
                el.scrollTop(el[0].scrollHeight);
            }

            // Refresh otomatis tiap 15 detik kalau sedang buka diskusi
            setInterval(() => {
                if (kdforumAktif) loadPesan(kdforumAktif);
            }, 15000);
        });
    </script>
@endpush
