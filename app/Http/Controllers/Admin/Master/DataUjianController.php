<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataUjian;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataUjianController extends Controller
{
    public function index()
    {
        $ujian = DataUjian::all();
        // dd($ujian);
        return view('admin.master.ujian.index', compact('ujian'));
    }

    // cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $ujian = DataUjian::where('kdujian', 'like', "%$query%")
                ->orwhere('judul', 'like', "%$query%")
                ->orwhere('deskripsi', 'like', "%$query%")
                ->orwhere('link', 'like', "%$query%")
                ->orwhere('hasil', 'like', "%$query%")
                ->orwhere('status', 'like', "%$query%")
                ->orwhere('judulFileAsli', 'like', "%$query%")
                ->get();
            return response()->json($ujian);
        }

        return redirect()->route('admin.master.ujian');
    }

    // Tambah Data
    public function tampildata()
    {
        return view('admin.master.ujian.tambah');
    }

    public function tambahdata(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'hasil' => 'required',
            'status' => 'required',
            'fileUjian' => 'nullable|file|max:20480',
        ], [
            'link.required' => 'link Wajib Diisi!.',
            // 'hasil.required' => 'hasil Wajib Diisi!.',
        ]);

        $mdl = null;
        $judulAsli = null;

        if ($request->hasFile('fileUjian')) {
            $file = $request->file('fileUjian');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileUjian', 'public');
        }

        $data = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link' => $request->input('link'),
            'hasil' => $request->input('hasil'),
            'status' => $request->input('status'),
            'fileUjian' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        DataUjian::create($data);

        return redirect()->route('admin.master.ujian')->with('success', 'Data Behasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdujian)
    {
        $ujian = DataUjian::where('kdujian', $kdujian)->firstOrFail();
        return view('admin.master.ujian.edit', compact('ujian'));
    }

    public function editdata(Request $request, $kdujian)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'hasil' => 'required',
            'status' => 'required',
            'fileUjian' => 'nullable|file|max:20480',
        ]);

        $ujian = DataUjian::where('kdujian', $kdujian)->firstOrFail();

        $data = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link' => $request->input('link'),
            'hasil' => $request->input('hasil'),
            'status' => $request->input('status'),
        ];

        if (!$request->has('gunakan_file_lama') && $request->hasFile('fileUjian')) {
            if ($ujian->fileUjian) {
                Storage::disk('public')->delete($ujian->fileUjian);
            }

            $file = $request->file('fileUjian');
            $data['fileUjian'] = $file->store('fileUjian', 'public');
            $data['judulFileAsli'] = $file->getClientOriginalName();
        }

        $ujian->update($data);

        return redirect()->route('admin.master.ujian')->with('success', 'Data Berhasil Diubah!');
    }

    // Hapus
    public function hapus($kdujian)
    {
        try {
            $ujian = DataUjian::where('kdujian', $kdujian)->firstOrFail();

            if ($ujian->fileUjian) {
                Log::info('File to be deleted: ' . $ujian->fileUjian);
                if (Storage::disk('public')->delete($ujian->fileUjian)) {
                    Log::info('File exits, attempting to delete');
                    $deleted = Storage::disk('public')->delete($ujian->fileUjian);
                    Log::info('Deletion result: ' . ($deleted ? 'Success' : 'Failed'));
                } else {
                    Log::warning('File does not exist in storage: ' . $ujian->fileUjian);
                }
            } else {
                Log::warning('No fileUjian found for kdujian: ' . $kdujian);
            }

            $ujian->delete();

            return redirect()->route('user.ujian.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting ujian: ' . $e->getMessage());
            return redirect()->route('admin.master.ujian')->with('error', 'Gagal menghapus data atau file. Silahkan coba lagi.');
        }
    }

    // Status
    public function updateStatus(Request $request)
    {
        $ujianId = $request->input('kdujian');
        $isChecked = $request->has('status') ? 'Ditampilkan' : 'Tidak Ditampilkan';

        $ujian = DataUjian::findorFail($ujianId);
        $ujian->status = $isChecked;
        $ujian->save();

        return redirect()->back()->with('status', 'Status Berhasil Diubah!');
    }
}
