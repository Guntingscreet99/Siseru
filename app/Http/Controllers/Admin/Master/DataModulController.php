<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataModul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataModulController extends Controller
{
    public function index(){
        $modul = DataModul::all();
        return view('admin.master.modul.index', compact('modul'));
    }

    public function cari(Request $request)
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

        return redirect()->route('admin.master.modul');
    }

    // Tambah Data
    public function tampiltambah(){
        return view('admin.master.modul.tambah');
    }

    public function tambah(Request $request){
        $request->validate([
            'judul' => 'required',
            'kelas' => 'required',
            'fileModul' => 'file|max:20480',
            'semester' => 'required',
            'tahun' => 'required',
            'topik' => 'required'
        ],[
            'judul.required' => 'Judul Wajib Diisi!',
            'kelas.required' => 'Kelas Wajib Diisi!',
            'semester.required' => 'Semester Wajib Diisi!',
            'tahun.required' => 'Tahun Wajib Diisi!',
            'topik.required' => 'Topik Wajib Diisi!'
        ]);

        $mdl = null;
        $judulAsli = null;

        if ($request->hasFile('fileModul')) {
            $file = $request->file('fileModul');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileModul', 'public');
        }

        DataModul::create([
            'judul' => $request->input('judul'),
            'kelas' => $request->input('kelas'),
            'semester' => $request->input('semester'),
            'tahun' => $request->input('tahun'),
            'topik' => $request->input('topik'),
            'fileModul' => $mdl,
            'judulFileAsli' => $judulAsli,
        ]);

        return redirect()->route('admin.master.modul')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function ubahmodul($kdmodul){
        $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

        // dd($modul);
        return view('admin.master.modul.edit', compact('modul'));
    }

    public function ubah(Request $request, $kdmodul){
        $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

        $request->validate([
            'judul' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
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
            'kelas' => $request->kelas,
            'semester' => $request->semester,
            'tahun' => $request->tahun,
            'topik' => $request->topik,
            'fileModul' => $mdl,
            'judulFileAsli' => $judulAsli,
        ]);

        return redirect()->route('admin.master.modul')->with('success', 'Data Berhasil Diubah');
    }

    // Hapus Data
    public function hapus($kdmodul){
        $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

        if ($modul->fileModul) {
            Storage::disk('public')->delete($modul->fileModul);
        }

        $modul->delete();

        return redirect()->route('admin.master.modul')->with('success', 'Data Berhasil Dihapus');
    }
}
