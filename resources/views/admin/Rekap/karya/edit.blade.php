<div class="modal fade" id="editkarya{{ $item->kdkarya }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Nilai Karya</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.rekap.karya.update', $item->kdkarya) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">

                        <!-- ================= KIRI : PREVIEW KARYA ================= -->
                        <div class="col-md-7 border-end">

                            <!-- TOOLBAR ZOOM -->
                            <div class="zoom text-center">
                                <p>Zoom Control</p>
                            </div>
                            <hr>
                            <div class="zoom-toolbar d-flex justify-content-center gap-2 mb-2">
                                <button type="button" class="btn btn-sm btn-secondary"
                                    onclick="zoomOut('{{ $item->kdkarya }}')">−</button>
                                <button type="button" class="btn btn-sm btn-secondary"
                                    onclick="zoomIn('{{ $item->kdkarya }}')">+</button>
                            </div>

                            <div class="preview-container">
                                <img src="{{ asset('storage/' . $item->fileKarya) }}" id="preview{{ $item->kdkarya }}"
                                    class="preview-image rounded shadow" draggable="false">
                            </div>
                        </div>

                        <!-- ================= KANAN : FORM NILAI ================= -->
                        <div class="col-md-5">

                            <!-- IDENTITAS MAHASISWA -->
                            <div class="p-2 rounded small">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="fw-bold">
                                            <i class="fa-solid fa-address-card"></i>
                                            Identitas Mahasiswa
                                        </h5>
                                        <hr>
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <th width="150px">Nama Mahasiswa</th>
                                                    <td width="10px">:</td>
                                                    <td class="fw-bold">{{ $item->namaMhs }}</td>
                                                </tr>
                                                <tr>
                                                    <th>NIM</th>
                                                    <td>:</td>
                                                    <td class="fw-bold">{{ $item->nim }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Kelas</th>
                                                    <td>:</td>
                                                    <td class="fw-bold">
                                                        {{ $item->user->datadiri->kelas->nama_kelas ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Semester</th>
                                                    <td>:</td>
                                                    <td class="fw-bold">
                                                        {{ $item->user->datadiri->semester->nama_semester ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Judul Karya</th>
                                                    <td>:</td>
                                                    <td class="fw-bold">{{ $item->namaKarya }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- FORM PENILAIAN -->
                            <div class="judul p-2">
                                <h5 class="fw-bold">
                                    <i class="fa-solid fa-file-pen"></i> Form Penilaian Karya
                                </h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Orisinalitas (0–20)</label>
                                            <input type="number" name="skor_orisinalitas"
                                                value="{{ $item->skor_orisinalitas }}" min="0" max="20"
                                                class="form-control mb-2 mt-2">
                                        </div>
                                        <div class="mb-3">
                                            <label>Teknik (0–20)</label>
                                            <input type="number" name="skor_teknik" value="{{ $item->skor_teknik }}"
                                                min="0" max="20" class="form-control mb-2 mt-2">
                                        </div>
                                        <div class="mb-3">
                                            <label>Komposisi & Estetika (0–20)</label>
                                            <input type="number" name="skor_komposisi_estetika"
                                                value="{{ $item->skor_komposisi_estetika }}" min="0"
                                                max="20" class="form-control mb-2 mt-2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Ekspresi & Makna (0–20)</label>
                                            <input type="number" name="skor_ekspresi_makna"
                                                value="{{ $item->skor_ekspresi_makna }}" min="0" max="20"
                                                class="form-control mb-2 mt-2">
                                        </div>
                                        <div class="mb-3">
                                            <label>Kesesuaian Tema (0–20)</label>
                                            <input type="number" name="skor_kesesuaian_tema"
                                                value="{{ $item->skor_kesesuaian_tema }}" min="0" max="20"
                                                class="form-control mb-2 mt-2">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>

            </form>

        </div>
    </div>
</div>

@push('css')
    <style>
        .preview-container {
            position: relative;
            width: 100%;
            height: 450px;
            overflow: hidden;
            border-radius: 8px;
            background: #f8f9fa;
            cursor: grab;
        }

        .preview-container:active {
            cursor: grabbing;
        }

        .preview-image {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(1);
            transition: transform 0.2s ease;
            max-width: none;
            user-select: none;
        }

        .zoom-toolbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: white;
            padding-bottom: 4px;
        }
    </style>
@endpush

@push('js')
    <script>
        const state = {};

        function initState(id) {
            if (!state[id]) {
                state[id] = {
                    scale: 1,
                    x: 0,
                    y: 0,
                    dragging: false,
                    startX: 0,
                    startY: 0
                };
            }
        }

        function applyTransform(id) {
            const img = document.getElementById('preview' + id);
            const s = state[id];
            img.style.transform = `translate(calc(-50% + ${s.x}px), calc(-50% + ${s.y}px)) scale(${s.scale})`;
        }

        function zoomIn(id) {
            initState(id);
            state[id].scale += 0.1;
            applyTransform(id);
        }

        function zoomOut(id) {
            initState(id);
            state[id].scale = Math.max(0.5, state[id].scale - 0.1);
            applyTransform(id);
        }
        document.addEventListener('mousedown', function(e) {
            if (e.target.classList.contains('preview-image')) {
                const id = e.target.id.replace('preview', '');
                initState(id);
                state[id].dragging = true;
                state[id].startX = e.clientX - state[id].x;
                state[id].startY = e.clientY - state[id].y;
            }
        });
        document.addEventListener('mousemove', function(e) {
            Object.keys(state).forEach(id => {
                if (state[id].dragging) {
                    state[id].x = e.clientX - state[id].startX;
                    state[id].y = e.clientY - state[id].startY;
                    applyTransform(id);
                }
            });
        });
        document.addEventListener('mouseup', function() {
            Object.keys(state).forEach(id => state[id].dragging = false);
        });
    </script>
@endpush
