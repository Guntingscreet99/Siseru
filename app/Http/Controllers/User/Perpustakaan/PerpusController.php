<?php

namespace App\Http\Controllers\User\Perpustakaan;

use App\Http\Controllers\Controller;
use App\Models\DataPerpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PerpusController extends Controller
{
    public function index()
    {
        $perpus = DataPerpustakaan::all();
        return view('user.menu.perpustakaan.index', compact('perpus'));
    }

    // Live Search (AJAX)
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $perpus = DataPerpustakaan::where('judul', 'like', "%$query%")
                ->orWhere('kategori', 'like', "%$query%")
                ->orWhere('topik', 'like', "%$query%")
                ->orWhere('tahun', 'like', "%$query%")
                ->orWhere('deskripsi', 'like', "%$query%")
                ->orWhere('judulFileAsli', 'like', "%$query%")
                ->get();

            return response()->json($perpus);
        }

        return redirect()->route('user.perpus.index');
    }

    // Form Tambah
    public function tampildata()
    {
        return view('user.menu.perpustakaan.tambah');
    }

    // Proses Tambah
    public function tambahdata(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|in:Buku,Jurnal,Artikel,Modul Pembelajaran',
            'topik'      => 'required|string|max:255',
            'tahun'      => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 5),
            'deskripsi'  => 'nullable|string',
            'filePerpus' => 'required|mimes:pdf,doc,docx,mp4,mkv,avi,jpg,jpeg,png|max:51200', // max 50MB
            'cover'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // max 2MB
        ], [
            'judul.required'     => 'Judul wajib diisi!',
            'kategori.required'  => 'Pilih salah satu kategori!',
            'filePerpus.required' => 'File wajib diunggah!',

        ]);

        $data = $request->only(['judul', 'deskripsi', 'kategori', 'topik', 'tahun']);

        // Simpan file utama
        if ($request->hasFile('filePerpus')) {
            $file = $request->file('filePerpus');

            $namaFile = time() . '_' . $file->getClientOriginalName();

            $file->move(public_path('uploads/perpus/files'), $namaFile);
            $data['filePerpus'] = 'uploads/perpus/files/' . $namaFile;

            $data['judulFileAsli'] = $file->getClientOriginalName();
        }

        // Simpan cover (opsional)
        if ($request->hasFile('cover')) {
            $cover = $request->file('cover');
            $namaCover = 'cover_' . time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('uploads/perpus/covers'), $namaCover);
            $data['cover'] = 'uploads/perpus/covers/' . $namaCover;
        }

        $data['user_id'] = Auth::id(); // Penting! Biar tahu siapa yang upload

        DataPerpustakaan::create($data);

        return redirect()->route('user.perpus.index')
            ->with('success', 'Koleksi berhasil ditambahkan ke Perpustakaan Digital!');
    }

    // Form Edit
    public function tampiledit($kdperpus)
    {
        $perpus = DataPerpustakaan::findOrFail($kdperpus);

        // Hanya pemilik yang boleh edit
        if ($perpus->user_id !== Auth::id()) {
            return redirect()->route('user.perpus.index')
                ->with('error', 'Kamu tidak memiliki akses untuk mengedit koleksi ini!');
        }

        return view('user.menu.perpustakaan.edit', compact('perpus'));
    }

    // Proses Edit
    public function editdata(Request $request, $kdperpus)
    {
        $perpus = DataPerpustakaan::findOrFail($kdperpus);

        // Hanya pemilik yang boleh edit
        if ($perpus->user_id !== Auth::id()) {
            return redirect()->route('user.perpus.index')
                ->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'judul'      => 'required|string|max:255',
            'kategori'   => 'required|in:Buku,Jurnal,Artikel,Modul Pembelajaran',
            'topik'      => 'required|string|max:255',
            'tahun'      => 'required|digits:4|integer',
            'deskripsi'  => 'nullable|string',
            'filePerpus' => 'nullable|mimes:pdf,doc,docx,mp4,mkv,avi,jpg,jpeg,png|max:51200',
            'cover'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['judul', 'deskripsi', 'kategori', 'topik', 'tahun']);

        // Ganti file utama kalau ada upload baru
        if ($request->hasFile('filePerpus')) {
            if ($perpus->filePerpus && Storage::disk('public')->exists($perpus->filePerpus)) {
                Storage::disk('public')->delete($perpus->filePerpus);
            }

            $file = $request->file('filePerpus');
            $namaFile = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/perpus/files'), $namaFile);
            $data['filePerpus'] = 'uploads/perpus/files/' . $namaFile;
            $data['judulFileAsli'] = $file->getClientOriginalName();
        }

        // Ganti cover kalau ada upload baru
        if ($request->hasFile('cover')) {
            if ($perpus->cover && Storage::disk('public')->exists($perpus->cover)) {
                Storage::disk('public')->delete($perpus->cover);
            }

            $cover = $request->file('cover');
            $namaCover = 'cover_' . time() . '.' . $cover->getClientOriginalExtension();
            $cover->move(public_path('uploads/perpus/covers'), $namaCover);
            $data['cover'] = 'uploads/perpus/covers/' . $namaCover;
        }

        $perpus->update($data);

        return redirect()->route('user.perpus.index')
            ->with('success', 'Koleksi berhasil diperbarui!');
    }

    // Hapus
    public function hapus($kdperpus)
    {
        $perpus = DataPerpustakaan::findOrFail($kdperpus);

        // Hanya pemilik yang boleh hapus
        if ($perpus->user_id !== Auth::id()) {
            return redirect()->route('user.perpus.index')
                ->with('error', 'Kamu tidak bisa menghapus koleksi orang lain!');
        }

        // Hapus file & cover
        if ($perpus->filePerpus) {
            Storage::disk('public')->delete($perpus->filePerpus);
        }
        if ($perpus->cover) {
            Storage::disk('public')->delete($perpus->cover);
        }

        $perpus->delete();

        return redirect()->route('user.perpus.index')
            ->with('success', 'Koleksi berhasil dihapus!');
    }
}
