<?php

namespace App\Http\Controllers\User\Menu\Ujian;

use App\Http\Controllers\Controller;
use App\Models\DataUjian;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UjianController extends Controller
{
    public function index()
    {
        $ujian = DataUjian::all();

        return view('user.menu.gamifikasi.index', compact('ujian'));
    }

    // Cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $ujian = DataUjian::where('kdUjian', 'like', "%$query%")
                ->orwhere('judul', 'like', "%$query%")
                ->orwhere('deskripsi', 'like', "%$query%")
                ->orwhere('link', 'like', "%$query%")
                ->orwhere('hasil', 'like', "%$query%")
                ->orWhere('judulFileAsli', 'like', "%$query%")
                ->get();

            return response()->json($ujian);
        }

        return redirect()->route('user.ujian.index');
    }

    // Tambah Data
    public function tampildata()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.gamifikasi.tambah', compact('kelas', 'semester'));
    }

    public function tambahdata(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'hasil' => 'required',
            'fileUjian' => 'file|max:51200',
        ], [
            'judul.required' => 'Judul Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'link.required' => 'link Tidak Wajib Diisi!',
            'fileUjian.max' => 'Ukuran File Maksimal 50MB!',
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
            'fileUjian' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        DataUjian::create($data);

        return redirect()->route('user.ujian.index')->with('success', 'Data Behasil Ditambah');
    }

    // Edit Data
    public function tampiledit($id)
    {
        $ujian = DataUjian::findOrFail($id);

        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.gamifikasi.edit', compact('ujian', 'kelas', 'semester'));
    }

    public function editdata(Request $request, $kdujian)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'hasil' => 'required',
            'fileUjian' => 'nullable|file|max:51200',
        ]);

        $ujian = DataUjian::where('kdujian', $kdujian)->firstOrFail();

        $data = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link' => $request->input('link'),
            'hasil' => $request->input('hasil'),
        ];

        if ($request->hasFile('fileUjian')) {
            // Hapus file lama jika ada
            if ($ujian->fileUjian) {
                Storage::disk('public')->delete($ujian->fileUjian);
            }

            $file = $request->file('fileUjian');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileUjian', 'public');

            $data['fileUjian'] = $mdl;
            $data['judulFileAsli'] = $judulAsli;
        }

        $ujian->update($data);

        return redirect()->route('user.ujian.index')->with('success', 'Data Berhasil Diubah');
    }

    // Hapus Data
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
            return redirect()->route('user.ujian.index')->with('error', 'Gagal menghapus data atau file. Silahkan coba lagi.');
        }
    }
}
