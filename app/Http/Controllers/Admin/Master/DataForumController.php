<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataForum;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class DataForumController extends Controller
{
    public function index()
    {
        $forum = DataForum::with('kelas', 'semester')->get();
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
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.forum.tambah', compact('kelas', 'semester'));
    }

    // Tambah Data
    public function tambahdata(Request $request)
    {
        $request->validate([
            'akun' => 'required',
            'id_kelas' => 'required',
            'id_semester' => 'required',
            'topik' => 'required',
            'tahun' => 'required',
            'fileForum' => 'nullable|file|max:20480',
        ], [
            'akun.required' => 'Akun Wajib Diisi!',
            'id_kelas.required' => 'Kelas Wajib Diisi!',
            'id_semester.required' => 'Semester Wajib Diisi!',
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
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'topik' => $request->input('topik'),
            'tahun' => $request->input('tahun'),
            'fileForum' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        // dd($data);

        DataForum::create($data);

        return redirect()->route('admin.master.forum')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdforum)
    {
        $forum = DataForum::where('kdforum', $kdforum)->firstOrFail();

        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.forum.edit', compact('forum', 'kelas', 'semester'));
    }

    public function editdata(Request $request, $kdforum)
    {
        $forum = DataForum::where('kdforum', $kdforum)->firstOrFail();

        $request->validate([
            'akun' => 'required',
            'id_kelas' => 'required',
            'id_semester' => 'required',
            'topik' => 'required',
            'tahun' => 'required',
            'fileForum' => 'nullable|file|max:20480',
        ]);


        // Cek apakah pengguna ingin menggunakan file lama atau mengganti dengan yang baru
        if (!$request->has('gunakan_file_lama') && $request->hasFile('fileForum')) {
            // Hapus File Lama Jika Ada
            if ($forum->fileForum) {
                Storage::disk('public')->delete($forum->fileForum);
            }

            if ($request->hasFile('fileForum')) {
                $file = $request->file('fileForum');
                $data['judulAsli'] = $file->getClientOriginalName();
                $data['fileForum'] = $file->store('fileForum', 'public');
            } else {
                $mdl = null;
                $judulAsli = null;
            }
        }

        $forum->update([
            'akun' => $request->input('akun'),
            'id_kelas' => $request->id_kelas,
            'id_semester' => $request->id_semester,
            'topik' => $request->input('topik'),
            'tahun' => $request->input('tahun'),
        ]);

        return redirect()->route('admin.master.forum')->with('success', 'Data Berhasil Diperbarui');
    }

    // hapus data
    public function hapus($kdforum)
    {
        try {
            $forum = DataForum::where('kdforum', $kdforum)->firstOrFail();

            if ($forum->fileForum) {
                Log::info('File to delete: ' . $forum->fileForum);
                if (Storage::disk('public')->exists($forum->fileForum)) {
                    Log::info('File exists, attempting to delete');
                    $deleted = Storage::disk('public')->delete($forum->fileForum);
                    Log::info('Deletion result: ' . ($deleted ? 'Success' : 'Failed'));
                } else {
                    Log::warning('File does not exist in storage: ' . $forum->fileForum);
                }
            } else {
                Log::warning('No fileForum found for kdforum: ' . $kdforum);
            }

            $forum->delete();

            return redirect()->route('admin.master.forum')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting forum: ' . $e->getMessage());
            return redirect()->route('admin.master.forum')->with('eror', 'Gagal menghapus data atau file. Silahkan coba lagi.');
        }
    }
}
