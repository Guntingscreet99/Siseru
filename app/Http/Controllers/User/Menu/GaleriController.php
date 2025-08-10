<?php

namespace App\Http\Controllers\User\Menu;

use App\Http\Controllers\Controller;
use App\Models\DataKarya;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Log;
use illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function index()
    {
        $karya = DataKarya::all();

        return view('user.menu.galeri_karya.index', compact('karya'));
    }

    // Cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $karya = DataKarya::where('kdkarya', 'like', "%$query%")
                ->orwhere('namaMhs', 'like', "%$query%")
                ->orwhere('namaKarya', 'like', "%$query%")
                ->orwhere('kelas', 'like', "%$query%")
                ->orwhere('semester', 'like', "%$query%")
                ->orwhere('deskripsi', 'like', "%$query%")
                ->orwhere('status', 'like', "%$query%")
                ->orwhere('judulFileAsli', 'like', "%$query%")
                ->get();
            return response()->json($karya);
        }

        return redirect()->route('admin.master.karya');
    }

    // Tambah Data
    public function tampildata()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.karya.tambah', compact('kelas', 'semester'));
    }

    public function tambahdata(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'namaMhs' => 'required',
                'namaKarya' => 'required',
                'id_kelas' => 'required',
                'id_semester' => 'required',
                'fileKarya' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mkv,avi|max:51200',
                'deskripsi' => 'required',
                'status' => 'required',
            ],
            [
                'namaMhs.required' => 'Nama Mahasiswa Wajib Diisi!',
                'namaKarya.required' => 'Nama Karya Wajib Diisi!',
                'id_kelas.required' => 'Kelas Wajib Diisi!',
                'id_semester.required' => 'Semester Wajib Diisi!',
                'deskripsi.required' => 'Deskripsi Wajib Diisi!',
                'fileKarya.required' => ' File Karya Wajib Diisi!',
            ]
        );

        $mdl = null;
        $judulAsli = null;

        if ($request->hasFile('fileKarya')) {
            $file = $request->file('fileKarya');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileKarya', 'public');
        }

        $data = [
            'namaMhs' => $request->input('namaMhs'),
            'namaKarya' => $request->input('namaKarya'),
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'deskripsi' => $request->input('deskripsi'),
            'status' => $request->input('status'),
            'fileKarya' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        // dd($data);

        DataKarya::create($data);

        return redirect()->route('admin.master.karya')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdkarya)
    {
        $karya = DataKarya::where('kdkarya', $kdkarya)->firstOrFail();

        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.karya.edit', compact('karya', 'kelas', 'semester'));
    }

    public function editdata(Request $request, $kdkarya)
    {
        $karya = DataKarya::where('kdkarya', $kdkarya)->firstOrFail();

        $request->validate([
            'namaMhs' => 'required',
            'namaKarya' => 'required',
            'id_kelas' => 'nullable',
            'id_semester' => 'nullable',
            'deskripsi' => 'required',
            // 'status' => 'required',
            'fileKarya' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mkv,avi|max:51200',
        ]);

        $mdl = $karya->fileKarya;
        $judulAsli = $karya->judulFileAsli;

        if (!$request->has('gunakan_file_lama') && $request->hasFile('fileKarya')) {
            if ($karya->fileKarya) {
                Storage::disk('public')->delete($karya->fileKarya);
            }

            if ($request->hasFile('fileKarya')) {
                $file = $request->file('fileKarya');
                $data['judulFileAsli'] = $file->getClientOriginalName();
                $data['fileKarya'] = $file->store('fileKarya', 'public');
            } else {
                $mdl = null;
                $judulAsli = null;
            }
        }

        $karya->update([
            'namaMhs' => $request->namaMhs,
            'namaKarya' => $request->namaKarya,
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'deskripsi' => $request->deskripsi,
            'fileKarya' => $mdl,
            'judulFileAsli' => $judulAsli,
        ]);

        return redirect()->route('admin.master.karya')->with('success', 'Data Berhasil Diubah!');
    }

    // Hapus Data
    public function hapus($kdkarya)
    {
        try {
            $karya = DataKarya::where('kdkarya', $kdkarya)->firstOrFail();

            if ($karya->fileKarya) {
                Log::info('File to delete: ' . $karya->fileKarya);
                if (Storage::disk('public')->exists($karya->fileKarya)) {
                    Log::info('File exists, attempting to delete');
                    $deleted = Storage::disk('public')->delete($karya->fileKarya);
                    Log::info('Deletion result: ' . ($deleted ? 'Success' : 'Failed'));
                } else {
                    Log::warning('File does not exist in storage: ' . $karya->fileKarya);
                }
            } else {
                Log::warning('No fileKarya found for kdkarya: ' . $kdkarya);
            }

            $karya->delete();

            return redirect()->route('admin.master.karya')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting karya: ' . $e->getMessage());
            return redirect()->route('admin.master.karya')->with('eror', 'Gagal menghapus data atau file. Silahkan coba lagi.');
        }
    }

    // Status
    public function updateStatus(Request $request)
    {
        $karyaId = $request->input('kdkarya');
        $isChecked = $request->has('status') ? 'Ditampilkan' : 'Tidak Ditampilkan';

        $karya = DataKarya::findorFail($karyaId);
        $karya->status = $isChecked;
        $karya->save();

        return redirect()->back()->with('status', 'Status Berhasil Diubah!');
    }
}
