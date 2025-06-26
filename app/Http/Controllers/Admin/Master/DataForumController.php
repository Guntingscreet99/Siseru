<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataForumController extends Controller
{
    public function index()
    {
        $forum = DataForum::all();
        // dd($forum);
        return view('admin.master.forum.index', compact('forum'));
    }

    // Cari
    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $forum = DataForum::where('kdforum', 'like', "%$query%")
                ->orWhere('akun', 'like', "%$query%")
                ->orWhere('kelas', 'like', "%$query%")
                ->orWhere('semester', 'like', "%$query%")
                ->orWhere('topik', 'like', "%$query%")
                ->orWhere('tahun', 'like', "%$query%")
                ->orWhere('judulFileAsli', 'like', "%$query%")
                ->get();

            return response()->json($forum);
        }

        return redirect()->route('admin.master.forum');
    }

    // Tampil Form Tambah
    public function tampildata()
    {
        return view('admin.master.forum.tambah');
    }

    // Tambah Data
    public function tambahdata(Request $request)
    {
        $request->validate([
            'akun' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
            'topik' => 'required',
            'tahun' => 'required',
            'fileForum' => 'nullable|file|max:20480',
        ], [
            'akun.required' => 'Akun Wajib Diisi!',
            'kelas.required' => 'Kelas Wajib Diisi!',
            'semester.required' => 'Semester Wajib Diisi!',
            'topik.required' => 'Topik Wajib Diisi!',
            'tahun.required' => 'Tahun Wajib Diisi!',
        ]);

        $mdl = null;
        $judulAsli = null;

        if ($request->hasFile('fileForum')) {
            $file = $request->file('fileForum');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileForum', 'public');
        }

        $data = [
            'akun' => $request->input('akun'),
            'kelas' => $request->input('kelas'),
            'semester' => $request->input('semester'),
            'topik' => $request->input('topik'),
            'tahun' => $request->input('tahun'),
            'fileForum' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        DataForum::create($data);

        return redirect()->route('admin.master.forum')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdforum)
    {
        $forum = DataForum::where('kdforum', $kdforum)->firstOrFail();

        return view('admin.master.forum.edit', compact('forum'));
    }

    public function editdata(Request $request, $kdforum)
    {
        $request->validate([
            'akun' => 'required',
            'kelas' => 'required',
            'semester' => 'required',
            'topik' => 'required',
            'tahun' => 'required',
            'fileForum' => 'nullable|file|max:20480',
        ]);

        $forum = DataForum::where('kdforum', $kdforum)->firstOrFail();

        // Cek apakah pengguna ingin menggunakan file lama atau mengganti dengan yang baru
        if (!$request->has('gunakan_file_lama') && $request->hasFile('fileForum')) {
            // Hapus File Lama Jika Ada
            if ($forum->fileForum) {
                Storage::disk('public')->delete($forum->fileForum);
            }

            $file = $request->file('fileForum');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileForum', 'Public');

            $forum->update([
                'fileForum' => $mdl,
                'judulFileAsli' => $judulAsli,
            ]);
        }

        $forum->update([
            'akun' => $request->input('akun'),
            'kelas' => $request->input('kelas'),
            'semester' => $request->input('semester'),
            'topik' => $request->input('topik'),
            'tahun' => $request->input('tahun'),
        ]);

        return redirect()->route('admin.master.forum')->with('success', 'Data Berhasil Diperbarui');
    }

    // hapus data
    public function hapus($kdforum)
    {
        $forum = DataForum::where('kdforum', $kdforum)->firstOrFail();

        // hapus file yang sudah ada
        if ($forum->fileForum) {
            Storage::disk('public')->delete($forum->fileForum);
        }

        // hapus data dari database
        $forum->delete();

        return redirect()->route('admin.master.forum')->with('success', 'Data Berhasil Dihapus');
    }
}
