<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataKarya;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DataKaryaController extends Controller
{
    public function index()
    {
        $karya = DataKarya::all();
        // dd($karya);
        return view('admin.master.karya.index', compact('karya'));
    }

    // Cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $karya = DataKarya::where('kdkarya', 'like', "%$query%")
                ->orwhere('id_user', 'like', "%$query%")
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
        return view('admin.master.karya.tambah');
    }

    public function tambahdata(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'id_user' => 'required',
                'namaKarya' => 'required',
                'id_kelas' => 'required',
                'id_semester' => 'required',
                'fileKarya' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mkv,avi|max:51200',
                'deskripsi' => 'required',
                'status' => 'required',
            ],
            [
                'nama.required' => 'Nama Karya Wajib Diisi!',
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
            'nama' => $request->input('nama'),
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
        return view('admin.master.karya.edit', compact('karya'));
    }

    public function editdata(Request $request, $kdkarya)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
            'semster' => 'required',
            'deskripsi' => 'required',
            // 'status' => 'required',
            'fileKarya' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mkv,avi|max:51200',
        ]);

        $karya = DataKarya::where('kdkarya', $kdkarya)->firstOrFail();

        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            'status' => $request->input('status'),
        ];

        if (!$request->has('gunakan_file_lama') && $request->hasFile('fileKarya')) {
            if ($karya->fileKarya) {
                Storage::disk('public')->delete($karya->fileKarya);
            }

            $file = $request->file('fileKarya');
            $data['fileKarya'] = $file->store('fileKarya', 'public');
            $data['judulFileAsli'] = $file->getClientOriginalName();
        }

        $karya->update($data);

        return redirect()->route('admin.master.karya')->with('success', 'Data Berhasil Diperbarui');
    }

    // Hapus Data
    public function hapus($kdkarya)
    {
        try {
            $karya = DataKarya::where('kdkarya', $kdkarya)->findOrFail();

            if ($karya->fileKarya) {
                Log::info('File to delete: ' . $karya->fileKarya);
                if (Storage::disk('public')->exists($karya->fileKarya)) {
                    Log::info('File exists, attempting to deleate');
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
            Log::eror('Eror deleting karya: ' . $e->getMessage());
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
