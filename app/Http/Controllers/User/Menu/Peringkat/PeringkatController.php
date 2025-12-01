<?php

namespace App\Http\Controllers\User\Menu\Peringkat;

use App\Http\Controllers\Controller;
use App\Models\DataPeringkat;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PeringkatController extends Controller
{
    public function index()
    {
        $peringkat = DataPeringkat::all();

        return view('user.menu.peringkat.index', compact('peringkat'));
    }

    // Cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $peringkat = DataPeringkat::where('kdperingkat', 'like', "%$query%")
                ->orwhere('namaMhs', 'like', "%$query%")
                ->orwhere('nim', 'like', "%$query%")
                ->orwhere('kelas', 'like', "%$query%")
                ->orwhere('semester', 'like', "%$query%")
                ->orwhere('skorKarya', 'like', "%$query%")
                ->orwhere('skorUjian', 'like', "%$query%")
                ->orwhere('ranking', 'like', "%$query%")
                // ->orwhere('status', 'like', "%$query%")
                ->get();
            return response()->json($peringkat);
        }

        return redirect()->route('user.peringkat.index');
    }

    // Tambah Data
    public function tampildata()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.peringkat.tambah', compact('kelas', 'semester'));
    }

    public function tambahdata(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'namaMhs' => 'required',
                'nim' => 'required',
                'id_kelas' => 'required',
                'id_semester' => 'required',
                'skorKarya' => 'required',
                'skorUjian' => 'required',
                'ranking' => 'required',
            ],
            [
                'namaMhs.required' => 'Nama Mahasiswa Wajib Diisi!',
                'nim.required' => 'NIM Wajib Diisi!',
                'id_kelas.required' => 'Kelas Wajib Diisi!',
                'id_semester.required' => 'Semester Wajib Diisi!',
                'skorKarya.required' => 'Skor Karya Wajib Diisi!.',
                'skorUjian.required' => 'Skor Ujian Wajib Diisi!.',
                'ranking.required' => 'Ranking Wajib Diisi!.',
            ]
        );

        $data = [
            'namaMhs' => $request->namaMhs,
            'nim' => $request->nim,
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'skorKarya' => $request->skorKarya,
            'skorUjian' => $request->skorUjian,
            'ranking' => $request->ranking,
        ];

        DataPeringkat::create($data);

        return redirect()->route('user.peringkat.index')->with('success', 'Data peringkat berhasil ditambahkan.');
    }

    // Edit Data
    public function tampiledit($kdperingkat)
    {
        $peringkat = DataPeringkat::findOrFail($kdperingkat);

        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.peringkat.edit', compact('peringkat', 'kelas', 'semester'));
    }

    public function editdata(Request $request, $kdperingkat)
    {
        $peringkat = DataPeringkat::findOrFail($kdperingkat);

        $request->validate(
            [
                'namaMhs' => 'required',
                'nim' => 'required',
                'id_kelas' => 'required',
                'id_semester' => 'required',
                'skorKarya' => 'required',
                'skorUjian' => 'required',
                'ranking' => 'required',
            ],
            [
                'namaMhs.required' => 'Nama Mahasiswa Wajib Diisi!',
                'nim.required' => 'NIM Wajib Diisi!',
                'id_kelas.required' => 'Kelas Wajib Diisi!',
                'id_semester.required' => 'Semester Wajib Diisi!',
                'skorKarya.required' => 'Skor Karya Wajib Diisi!.',
                'skorUjian.required' => 'Skor Ujian Wajib Diisi!.',
                'ranking.required' => 'Ranking Wajib Diisi!.',
            ]
        );

        $peringkat->update($request->all());

        return redirect()->route('user.peringkat.index')->with('success', 'Data peringkat berhasil diupdate.');
    }

    // Hapus Data
    public function hapus($kdperingkat)
    {
        $peringkat = DataPeringkat::where('kdperingkat', $kdperingkat)->firstOrfail();

        $peringkat->delete();

        return redirect()->route('user.peringkat.index')->with('success', 'Data Berhasil Dihapus!.');
    }
}
