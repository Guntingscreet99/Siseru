<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataForum;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DataForumController extends Controller
{
    public function index()
    {
        $forum = DataForum::with('kelas', 'semester')->latest()->get();
        return view('admin.master.forum.index', compact('forum'));
    }

    // === CARI AJAX ===
    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $forum = DataForum::with('kelas', 'semester')
                ->where('kdforum', 'like', "%$query%")
                ->orWhere('akun', 'like', "%$query%")
                ->orWhere('topik', 'like', "%$query%")
                ->orWhere('tahun', 'like', "%$query%")
                ->orWhereHas('kelas', fn($q) => $q->where('nama_kelas', 'like', "%$query%"))
                ->orWhereHas('semester', fn($q) => $q->where('nama_semester', 'like', "%$query%"))
                ->get();

            return response()->json($forum);
        }

        return redirect()->route('admin.master.forum');
    }

    // === TAMPIL FORM TAMBAH ===
    public function tampildata()
    {
        $kelas    = Kelas::all();
        $semester = Semester::all();
        return view('admin.master.forum.tambah', compact('kelas', 'semester'));
    }

    // === SIMPAN DATA BARU ===
    public function tambahdata(Request $request)
    {
        $request->validate([
            'akun'         => 'required|string|max:255',
            'id_kelas'     => 'required|exists:kelas,id',
            'id_semester'  => 'required|exists:semesters,id',
            'topik'        => 'required|string',
            'tahun'        => 'required|string|max:20',
            'durasi_menit' => 'required|integer|min:5|max:1440',
            'fileForum'    => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,mp4,avi,mkv|max:51200', // 50MB
        ]);

        $filePath = null;
        $fileNameAsli = null;

        if ($request->hasFile('fileForum')) {
            $file = $request->file('fileForum');
            $fileNameAsli = $file->getClientOriginalName();
            $filePath = $file->store('forum-files', 'public');
        }

        DataForum::create([
            'kdforum'       => 'FRM' . Str::upper(Str::random(8)),
            'akun'          => $request->akun,
            'id_kelas'      => $request->id_kelas,
            'id_semester'   => $request->id_semester,
            'topik'         => $request->topik,
            'tahun'         => $request->tahun,
            'durasi_menit'  => $request->durasi_menit,
            'fileForum'     => $filePath,
            'judulFileAsli' => $fileNameAsli,
            // waktu_selesai akan otomatis diisi oleh model (booted)
        ]);

        return redirect()
            ->route('admin.master.forum')
            ->with('success', 'Forum diskusi berhasil ditambahkan!');
    }

    // === TAMPIL FORM EDIT ===
    public function tampiledit($kdforum)
    {
        $forum    = DataForum::where('kdforum', $kdforum)->firstOrFail();
        $kelas    = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.forum.edit', compact('forum', 'kelas', 'semester'));
    }

    // === UPDATE DATA ===
    public function editdata(Request $request, $kdforum)
    {
        $forum = DataForum::where('kdforum', $kdforum)->firstOrFail();

        $request->validate([
            'akun'         => 'required|string|max:255',
            'id_kelas'     => 'required|exists:kelas,id',
            'id_semester'  => 'required|exists:semesters,id',
            'topik'        => 'required|string',
            'tahun'        => 'required|string|max:20',
            'durasi_menit' => 'required|integer|min:5|max:1440',
            'fileForum'    => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,jpg,jpeg,png,mp4,avi,mkv|max:51200',
        ]);

        $data = [
            'akun'         => $request->akun,
            'id_kelas'     => $request->id_kelas,
            'id_semester'  => $request->id_semester,
            'topik'        => $request->topik,
            'tahun'        => $request->tahun,
            'durasi_menit' => $request->durasi_menit,
        ];

        // === HANDLE FILE ===
        if ($request->hasFile('fileForum')) {
            // Hapus file lama
            if ($forum->fileForum && Storage::disk('public')->exists($forum->fileForum)) {
                Storage::disk('public')->delete($forum->fileForum);
            }

            $file = $request->file('fileForum');
            $data['judulFileAsli'] = $file->getClientOriginalName();
            $data['fileForum']     = $file->store('forum-files', 'public');
        }
        // Jika tidak ada file baru → tetap pakai yang lama

        $forum->update($data);

        return redirect()
            ->route('admin.master.forum')
            ->with('success', 'Forum berhasil diperbarui!');
    }

    // === HAPUS DATA ===
    public function hapus($kdforum)
    {
        $forum = DataForum::where('kdforum', $kdforum)->firstOrFail();

        // Hapus file jika ada
        if ($forum->fileForum && Storage::disk('public')->exists($forum->fileForum)) {
            Storage::disk('public')->delete($forum->fileForum);
        }

        $forum->delete();

        return redirect()
            ->route('admin.master.forum')
            ->with('success', 'Forum berhasil dihapus!');
    }

    // AdminForumController.php
    public function lihatRekap($kdforum)
    {
        $forum = DataForum::with(['kelas', 'semester', 'rekap'])->where('kdforum', $kdforum)->firstOrFail();
        return view('admin.master.forum.rekap', compact('forum'));
    }

    public function downloadRekap($kdforum)
    {
        $forum = DataForum::with('rekap')->where('kdforum', $kdforum)->firstOrFail();
        if (!$forum->rekap) abort(404);

        $filename = "Rekap_Forum_{$forum->kdforum}.txt";
        return response($forum->rekap->isi_rekap)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }
}
