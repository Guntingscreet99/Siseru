<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataPeringkat;
use App\Models\Kelas;
use App\Models\RekapNilai;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DataPeringkatController extends Controller
{
    public function index(Request $request)
    {
        $kelasId    = $request->kelas_id;
        $semesterId = $request->semester_id;
        $nilaiHuruf = $request->nilai;

        $kelas    = Kelas::all();
        $semester = Semester::all();

        /**
         * ============================
         * AMBIL DATA REKAP
         * ============================
         */
        $rangking = RekapNilai::with(['kelas', 'semester'])
            ->when($kelasId, function ($q) use ($kelasId) {
                $q->where('id_kelas', $kelasId);
            })
            ->when($semesterId, function ($q) use ($semesterId) {
                $q->where('id_semester', $semesterId);
            })
            // ->orderByDesc('nilai_angka') // KUNCI PERINGKAT
            ->get();

        $rangking = $rangking->sortByDesc(function ($item) {
            return $item->nilai_angka;
        })->values();

        /**
         * ============================
         * FILTER NILAI HURUF (OPSIONAL)
         * ============================
         */
        if ($nilaiHuruf && $nilaiHuruf !== 'semua') {
            $rangking = $rangking->filter(function ($item) use ($nilaiHuruf) {
                return optional($item->grade)->huruf === $nilaiHuruf;
            })->values();
        }

        /**
         * ============================
         * HITUNG PERINGKAT
         * ============================
         */
        $peringkat = 1;
        $lastScore = null;

        $rangking->transform(function ($item, $index) use (&$peringkat, &$lastScore) {
            if ($lastScore !== null && $item->nilai_angka < $lastScore) {
                $peringkat = $index + 1;
            }

            $item->peringkat = $peringkat;
            $lastScore = $item->nilai_angka;

            return $item;
        });

        return view('admin.master.peringkat.index', compact(
            'rangking',
            'kelas',
            'semester'
        ));
    }

    // public function index()
    // {
    //     $peringkat = DataPeringkat::all();
    //     // dd($peringkat);
    //     return view('admin.master.peringkat.index', compact('peringkat'));
    // }

    // Cari
    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $peringkat = DataPeringkat::where('id', 'like', "%$query%")
                ->orwhere('namaMhs', 'like', "%$query%")
                ->orwhere('nim', 'like', "%$query%")
                ->orwhere('kelas', 'like', "%$query%")
                ->orwhere('semester', 'like', "%$query%")
                ->orWhere('skorKarya', 'like', "%$query%")
                ->orWhere('skorUjian', 'like', "%$query%")
                ->orWhere('ranking', 'like', "%$query%")
                ->orWhere('status', 'like', "%$query%")
                ->get();

            return response()->json($peringkat);
        }

        return redirect()->route('admin.master.peringkat');
    }

    // Tambah Data
    public function tampildata()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.peringkat.tambah', compact('kelas', 'semester'));
    }

    public function tambahdata(Request $request)
    {
        $request->validate(
            [
                'namaMhs' => 'required',
                'nim' => 'required',
                'id_kelas' => 'required',
                'id_semester' => 'required',
                'skorKarya' => 'required',
                'skorUjian' => 'required',
                'ranking' => 'required',
                'status' => 'required',
            ],
            [
                'namaMhs.required' => 'Nama Mahasiswa Wajib Diisi!',
                'nim.required' => 'NIM Wajib Diisi!',
                'id_kelas.required' => 'Kelas Wajib Diisi!',
                'id_semester.required' => 'Semester Wajib Diisi!',
                'skorKarya.required' => 'Skor Karya Wajib Diisi!.',
                'skorUjian.required' => 'Skor Ujian Wajib Diisi!.',
                'ranking.required' => 'Rangking Wajib Diisi!.',
            ]
        );

        $data = [
            'namaMhs' => $request->input('namaMhs'),
            'nim' => $request->input('nim'),
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'skorKarya' => $request->input('skorKarya'),
            'skorUjian' => $request->input('skorUjian'),
            'ranking' => $request->input('ranking'),
            'status' => $request->input('status'),
        ];

        DataPeringkat::create($data);

        return redirect()->route('admin.master.peringkat')->with('success', 'Data Berhasil Ditambah');
    }

    // edit
    public function tampiledit($kdperingkat)
    {
        $peringkat = DataPeringkat::where('kdperingkat', $kdperingkat)->firstOrFail();

        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.peringkat.edit', compact('peringkat', 'kelas', 'semester'));
    }

    public function editdata(Request $request, $kdperingkat)
    {
        $peringkat = DataPeringkat::where('kdperingkat', $kdperingkat)->firstOrFail();

        $request->validate([
            'namaMhs' => 'required',
            'nim' => 'required',
            'id_kelas' => 'required',
            'id_semester' => 'required',
            'skorKarya' => 'required',
            'skorUjian' => 'required',
            'ranking' => 'required',
            'status' => 'required',
        ]);

        $data = [
            'namaMhs' => $request->namaMhs,
            'nim' => $request->nim,
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'skorKarya' => $request->skorKarya,
            'skorUjian' => $request->skorUjian,
            'ranking' => $request->ranking,
            'status' => $request->status,
        ];

        $peringkat->update($data);

        return redirect()->route('admin.master.peringkat')->with('success', 'Data Berhasil Ditambah');
    }

    // hapus

    public function hapus($kdperingkat)
    {
        $peringkat = DataPeringkat::where('kdperingkat', $kdperingkat)->firstOrfail();

        $peringkat->delete();

        return redirect()->route('admin.master.peringkat')->with('success', 'Data Berhasil Dihapus!.');
    }

    // Status
    public function updateStatus(Request $request)
    {
        $peringkatId = $request->input('kdperingkat');
        $isChecked = $request->has('status') ? 'Ditampilkan' : 'Tidak Ditampilkan';

        $peringkat = DataPeringkat::findorFail($peringkatId);
        $peringkat->status = $isChecked;
        $peringkat->save();

        return redirect()->back()->with('status', 'Status Berhasil Diubah');
    }
}
