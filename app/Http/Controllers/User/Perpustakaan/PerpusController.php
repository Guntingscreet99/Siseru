<?php

namespace App\Http\Controllers\User\Perpustakaan;

use App\Http\Controllers\Controller;
use App\Models\DataPerpustakaan;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PerpusController extends Controller
{
    public function index()
    {
        $perpus = DataPerpustakaan::all();

        return view('user.menu.perpustakaan.index', compact('perpus'));
    }

    // Cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $perpus = DataPerpustakaan::where('kdperpus', 'like', "%$query%")
                ->orWhere('judul', 'like', "%$query%")
                ->orWhere('deskripsi', 'like', "%$query%")
                ->orWhere('kategori', 'like', "%$query%")
                ->orWhere('topik', 'like', "%$query%")
                ->orWhere('tahun', 'like', "%$query%")
                ->orWhere('judulFileAsli', 'like', "%$query%")
                ->get();

            return response()->json($perpus);
        }

        return redirect()->route('user.perpus.index');
    }

    // Tambah Data
    public function tampildata()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.perpustakaan.tambah', compact('kelas', 'semester'));
    }

    public function tambahdata(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'topik' => 'required',
            'tahun' => 'required',
            'filePerpus' => 'file|max:100480',
        ], [
            'judul.required' => 'Judul Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'kategori.required' => 'Kategori Wajib Diisi!',
            'topik.required' => 'Topik Wajib Diisi!',
            'tahun.required' => 'Tahun Wajib Diisi!',
        ]);

        $mdl = null;
        $judulAsli = null;

        if ($request->hasFile('filePerpus')) {
            $file = $request->file('filePerpus');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('filePerpus', 'public');
        }

        $data = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
            'topik' => $request->input('topik'),
            'tahun' => $request->input('tahun'),
            'status' => $request->input('status'),
            'filePerpus' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        DataPerpustakaan::create($data);

        // dd($data);
        return redirect()->route('user.perpus.index')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdperpus)
    {
        $perpus = DataPerpustakaan::findOrFail($kdperpus);
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.perpustakaan.edit', compact('perpus', 'kelas', 'semester'));
    }

    public function editdata(Request $request, $kdperpus)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'topik' => 'required',
            'tahun' => 'required',
            'filePerpus' => 'file|max:100480',
        ], [
            'judul.required' => 'Judul Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'kategori.required' => 'Kategori Wajib Diisi!',
            'topik.required' => 'Topik Wajib Diisi!',
            'tahun.required' => 'Tahun Wajib Diisi!',
        ]);

        $perpus = DataPerpustakaan::findOrFail($kdperpus);

        $mdl = $perpus->filePerpus;
        $judulAsli = $perpus->judulFileAsli;

        if ($request->hasFile('filePerpus')) {
            // Hapus file lama jika ada
            if ($mdl) {
                Storage::disk('public')->delete($mdl);
            }

            $file = $request->file('filePerpus');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('filePerpus', 'public');
        }

        $data = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
            'topik' => $request->input('topik'),
            'tahun' => $request->input('tahun'),
            'status' => $request->input('status'),
            'filePerpus' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        $perpus->update($data);

        return redirect()->route('user.perpus.index')->with('success', 'Data Berhasil Diedit');
    }

    // HAPUS
    public function hapus($kdperpus)
    {
        try {
            $perpus = DataPerpustakaan::where('kdperpus', $kdperpus)->firstOrFail();

            if ($perpus->filePerpus) {
                Log::info('File to be deleted: ' . $perpus->filePerpus);
                if (Storage::disk('public')->delete($perpus->filePerpus)) {
                    Log::info('File exits, attempting to delete');
                    $deleted = Storage::disk('public')->delete($perpus->filePerpus);
                    Log::info('Deletion result: ' . ($deleted ? 'Success' : 'Failed'));
                } else {
                    Log::warning('File does not exist in storage: ' . $perpus->filePerpus);
                }
            } else {
                Log::warning('No filePerpus found for kdperpus: ' . $kdperpus);
            }

            $perpus->delete();

            return redirect()->route('user.perpus.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting Perpus: ' . $e->getMessage());
            return redirect()->route('user.perpus.index')->with('error', 'Gagal menghapus data atau file. Silahkan coba lagi.');
        }
    }
}
