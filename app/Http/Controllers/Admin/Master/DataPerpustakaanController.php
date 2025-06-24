<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataPerpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPerpustakaanController extends Controller
{
    public function index()
    {
        $perpus = DataPerpustakaan::all();
        return view('admin.master.perpustakaan.index', compact('perpus'));
    }

    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $perpus = DataPerpustakaan::where('id', 'like', "%$query%")
                ->orWhere('judul', 'like', "%$query%")
                ->orWhere('deskripsi', 'like', "%$query%")
                ->orWhere('kategori', 'like', "%$query%")
                ->orWhere('topik', 'like', "%$query%")
                ->orWhere('tahun', 'like', "%$query%")
                ->orWhere('judulFileAsli', 'like', "%$query%")
                ->orWhere('status', 'like', "%$query%")
                ->get();

            return response()->json($perpus);
        }

        return redirect()->route('admin.master.perpus');
    }

    // Tambah Data
    public function tampildata()
    {
        return view('admin.master.perpustakaan.tambah');
    }

    public function tambahdata(Request $request)
    {
        // Validasai imput data di modal
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'topik' => 'required',
            'tahun' => 'required',
            'filePerpus' => 'nullable|file|max:20480',
            'status' => 'required',
        ], [
            'judul.required' => 'Judul Wajib Diisi!.',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!.',
            'kategori.required' => 'Kategori Wajib Diisi!.',
            'topik.required' => 'Topik Wajib Diisi!.',
            'tahun.required' => 'Tahun Wajib Diisi!.',
            // 'filePerpus.required' => 'File Perpustakaan Wajib Diisi!.',
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
        return redirect()->route('admin.master.perpus')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdperpus)
    {
        $perpus = DataPerpustakaan::where('kdperpus', $kdperpus)->firstOrFail();
        return view('admin.master.perpustakaan.edit', compact('perpus'));
    }

    public function editdata(Request $request, $kdperpus)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori' => 'required',
            'topik' => 'required',
            'tahun' => 'required',
            'filePerpus' => 'nullable|file|max:20480',
            'status' => 'required',
        ]);

        $perpus = DataPerpustakaan::where('kdperpus', $kdperpus)->firstOrFail();

        if (!$request->has('gunakan_file_lama') && $request->hasFile('filePerpus')) {
            if ($perpus->filePerpus) {
                Storage::disk('public')->delete($perpus->filePerpus);
            }

            $file = $request->file('filePerpus');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('filePerpus', 'public');

            $perpus->update([
                'filePerpus' => $mdl,
                'judulFileAsli' => $judulAsli,
            ]);
        }

        $perpus->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'kategori' => $request->input('kategori'),
            'topik' => $request->input('topik'),
            'tahun' => $request->input('tahun'),
            'status' => $request->input('status'),

        ]);

        return redirect()->route('admin.master.perpus')->with('success', 'Data Berhasil Diubah');
    }

    // Hapus Data
    public function hapus($kdperpus)
    {
        $perpus = DataPerpustakaan::where('kdperpus', $kdperpus)->firstOrFail();

        if ($perpus->filePerpus) {
            Storage::disk('public')->delete($perpus->filePerpus);
        }

        $perpus->delete();

        return redirect()->route('admin.master.perpus')->with('success', 'Data Berhasil Dihapus');
    }

    // Status
    public function updateStatus(Request $request)
    {
        $perpusId = $request->input('kdperpus');
        $isChecked = $request->has('status') ? 'Ditampilkan' : 'Tidak Ditampilkan';

        $perpus = DataPerpustakaan::findorFail($perpusId);
        $perpus->status = $isChecked;
        $perpus->save();

        return redirect()->back()->with('status', 'Status Berhasil Diubah');
    }
}
