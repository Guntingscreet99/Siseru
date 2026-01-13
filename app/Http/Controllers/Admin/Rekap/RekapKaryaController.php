<?php

namespace App\Http\Controllers\Admin\Rekap;

use App\Http\Controllers\Controller;
use App\Models\DataKarya;
use App\Models\Karya; // Asumsi model Karya
use App\Models\Kelas;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

class RekapKaryaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kelasId = $request->input('kelas');
        $entries = $request->input('entries', 10);

        $query = DataKarya::with(['user.datadiri.kelas', 'user.datadiri.semester'])
            ->orderBy('total_nilai', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('username', 'like', "%$search%")
                        ->orWhere('nama_lengkap', 'like', "%$search%")
                        ->orWhere('nim', 'like', "%$search%");
                })
                    ->orWhere('namaKarya', 'like', "%$search%");
            });
        }


        if ($kelasId) {
            $query->whereHas('user.datadiri', function ($q) use ($kelasId) {
                $q->where('id_kelas', $kelasId);
            });
        }

        $rekap = $query->paginate($entries);

        // Top 3 user tercepat (berdasarkan total nilai keseluruhan)
        $topUsersQuery = DataKarya::select('user_id', DB::raw('AVG(total_nilai) as avg_nilai'))
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('avg_nilai', 'desc')
            ->take(3);

        if ($kelasId) {
            $topUsersQuery->whereHas('user.datadiri', function ($q) use ($kelasId) {
                $q->where('id_kelas', $kelasId);
            });
        }

        if ($search) {
            $topUsersQuery->whereHas('user', function ($q) use ($search) {
                $q->where('username', 'like', '%' . $search . '%')
                    ->orWhere('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nim', 'like', '%' . $search . '%');
            });
        }

        $topUsers = $topUsersQuery->get();

        // Ambil data kelas dengan aman
        $kelas = Kelas::select('id', 'nama_kelas')->get();
        if (! $kelas instanceof Collection) {
            $kelas = collect([]);
        }

        // dd($rekap);

        return view('admin.Rekap.karya.index', compact('rekap', 'topUsers', 'search', 'kelas', 'entries'));
    }

    // Contoh method edit (tambah ini jika perlu form edit nilai)
    // public function edit($kdkarya)
    // {
    //     $karya = DataKarya::findOrFail($kdkarya);
    //     return view('admin.Rekap.karya.edit', compact('karya'));
    // }

    public function update(Request $request, $kdkarya)
    {
        $karya = DataKarya::findOrFail($kdkarya);
        $request->validate([
            'skor_deskripsi' => 'integer|min:1|max:5',
            'skor_analisis' => 'integer|min:1|max:5',
            'skor_interpretasi' => 'integer|min:1|max:5',
            'skor_penilaian' => 'integer|min:1|max:5',
        ]);

        $karya->update($request->only([
            'skor_deskripsi',
            'skor_analisis',
            'skor_interpretasi',
            'skor_penilaian'
        ]));

        // Hitung ulang total
        $bobot = [20, 30, 30, 20];
        $skors = [$karya->skor_deskripsi, $karya->skor_analisis, $karya->skor_interpretasi, $karya->skor_penilaian];
        $tertimbang = array_map(fn($s, $b) => $s * ($b / 5), $skors, $bobot);
        $karya->total_nilai = array_sum($tertimbang);
        $karya->save();

        return redirect()->route('admin.rekap.karya')->with('success', 'Nilai updated');
    }




    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'judul' => 'required|string|max:255',
    //         'file_gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
    //         // tambah validasi lain jika perlu
    //     ]);

    //     $karya = new DataKarya($request->all());
    //     $karya->user_id = auth()->id(); // atau dari input jika admin upload

    //     // Simpan file gambar
    //     if ($request->hasFile('file_gambar')) {
    //         $karya->file_gambar = $request->file('file_gambar')->store('karya', 'public');
    //     }

    //     // Set nilai otomatis maksimal
    //     $karya->skor_deskripsi = 5;
    //     $karya->skor_analisis = 5;
    //     $karya->skor_interpretasi = 5;
    //     $karya->skor_penilaian = 5;
    //     $karya->total_nilai = 100; // atau hitung dinamis: $this->hitungTotal($karya);

    //     $karya->save();

    //     return redirect()->back()->with('success', 'Karya berhasil diupload');
    // }
}
    