<?php

namespace App\Http\Controllers\User\Menu\Modul;

use App\Http\Controllers\Controller;
use App\Models\DataModul;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    public function index()
    {
        $modul = DataModul::all();

        return view('user.menu.modul.index', compact('modul'));
    }

    // Cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $modul = DataModul::where('id', 'like', "%$query%")
                ->orWhere('judul', 'like', "%$query%")
                ->orWhere('kelas', 'like', "%$query%")
                ->orWhere('semester', 'like', "%$query%")
                ->orWhere('topik', 'like', "%$query%")
                ->orWhere('tahun', 'like', "%$query%")
                ->orWhere('judulFileAsli', 'like', "%$query%")
                ->get();

            return response()->json($modul);
        }

        return redirect()->route('user.modul.index');
    }

    // Tambah Data
    public function tampildata()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.modul.tambah', compact('kelas', 'semester'));
    }

    public function tambahdata(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'id_kelas' => 'required',
            'id_semester' => 'required',
            'tahun' => 'required',
            'topik' => 'required',
            'fileModul' => 'file|max:20480',

        ], [
            'judul.required' => 'Judul Wajib Diisi!',
            'id_kelas.required' => 'Kelas Wajib Diisi!',
            'id_semester.required' => 'Semester Wajib Diisi!',
            'tahun.required' => 'Tahun Wajib Diisi!',
            'topik.required' => 'Topik Wajib Diisi!',
            'fileModul.required' => 'File Modul Wajib Diisi!',
        ]);

        $mdl = null;
        $judulAsli = null;

        if ($request->hasFile('fileModul')) {
            $file = $request->file('fileModul');
            $judulAsli = $file->getClientOriginalName(); // Ambil nama file asli
            $mdl = $file->store('fileModul', 'public'); // Simpan file
        }

        $data = [
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'judul' => $request->input('judul'),
            'tahun' => $request->input('tahun'),
            'topik' => $request->input('topik'),
            'fileModul' => $mdl,
            'judulFileAsli' => $judulAsli, // Pastikan tersimpan
        ];

        // dd($data);

        DataModul::create($data);

        return redirect()->route('user.modul.index')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdmodul)
    {
        $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

        $kelas = Kelas::all();
        $semester = Semester::all();
        // dd($modul);
        return view('user.menu.modul.edit', compact('modul', 'kelas', 'semester'));
    }

    public function editdata(Request $request, $kdmodul)
    {
        $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

        $request->validate([
            'judul' => 'required',
            'id_kelas' => 'required',
            'id_semester' => 'required',
            'tahun' => 'required',
            'topik' => 'required',
            'fileModul' => 'nullable|file|max:20480',
        ]);

        $mdl = $modul->fileModul;
        $judulAsli = $modul->judulFileAsli;

        // Jika checkbox "gunakan_file_lama" tidak dicentang atau file baru diunggah, update file
        if (!$request->has('gunakan_file_lama') || $request->hasFile('fileModul')) {
            // Hapus file lama jika ada file baru
            if ($modul->fileModul) {
                Storage::disk('public')->delete($modul->fileModul);
            }

            // Simpan file baru
            if ($request->hasFile('fileModul')) {
                $file = $request->file('fileModul');
                $judulAsli = $file->getClientOriginalName();
                $mdl = $file->store('fileModul', 'public');
            } else {
                // Jika checkbox tidak dicentang tapi user tidak mengunggah file baru, kosongkan file
                $mdl = null;
                $judulAsli = null;
            }
        }

        $modul->update([
            'judul' => $request->judul,
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'tahun' => $request->tahun,
            'topik' => $request->topik,
            'fileModul' => $mdl,
            'judulFileAsli' => $judulAsli,
        ]);

        return redirect()->route('user.modul.index')->with('success', 'Data Berhasil Diubah');
    }

    // Hapus Data
    public function hapus($kdmodul)
    {
        try {
            $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

            if ($modul->fileModul) {
                Log::info('File to delete: ' . $modul->fileModul); // Log path file
                if (Storage::disk('public')->exists($modul->fileModul)) {
                    Log::info('File exists, attempting to delete');
                    $deleted = Storage::disk('public')->delete($modul->fileModul);
                    Log::info('Deletion result: ' . ($deleted ? 'Success' : 'Failed'));
                } else {
                    Log::warning('File does not exist in storage: ' . $modul->fileModul);
                }
            } else {
                Log::warning('No fileModul found for kdmodul: ' . $kdmodul);
            }

            $modul->delete();

            return redirect()->route('user.modul.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting modul: ' . $e->getMessage());
            return redirect()->route('user.modul.index')->with('error', 'Gagal menghapus data atau file. Silahkan coba lagi.');
        }
    }
}
