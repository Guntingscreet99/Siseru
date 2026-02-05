<div class="modal fade" id="detailNilai{{ $item->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title fw-bold">
                    <i class="fas fa-chart-bar me-2"></i> Detail Nilai Mahasiswa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <table class="table table-bordered">
                    <tr>
                        <th width="35%">Nama</th>
                        <td>{{ $item->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>NIM</th>
                        <td>{{ $item->nim }}</td>
                    </tr>
                    <tr>
                        <th>Kelas</th>
                        <td>{{ $item->kelas->nama_kelas ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Semester</th>
                        <td>{{ $item->semester->nama_semester ?? '-' }}</td>
                    </tr>

                    <tr class="table-primary">
                        <th colspan="2" class="text-center">Rincian Nilai</th>
                    </tr>

                    <tr>
                        <th>Nilai Karya (40%)</th>
                        <td>{{ number_format($item->rekap_karya, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Ujian (40%)</th>
                        <td>{{ number_format($item->rekap_ujian, 2) }}</td>
                    </tr>
                    <tr>
                        <th>Nilai Diskusi (20%)</th>
                        <td>{{ number_format($item->rekap_diskusi, 2) }}</td>
                    </tr>

                    <tr class="table-success fw-bold">
                        <th>Nilai Akhir</th>
                        <td>
                            {{ number_format($item->nilai_angka, 2) }}
                            ({{ $item->grade->huruf ?? '-' }})
                        </td>
                    </tr>
                </table>
            </div>

            <div class="modal-footer">
                <span class="me-auto badge {{ ($item->grade->bobot ?? 0) >= 2 ? 'bg-success' : 'bg-danger' }}">
                    {{ ($item->grade->bobot ?? 0) >= 2 ? 'LULUS' : 'TIDAK LULUS' }}
                </span>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Tutup
                </button>
            </div>

        </div>
    </div>
</div>
