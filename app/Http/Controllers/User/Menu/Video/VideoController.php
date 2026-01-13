<?php

namespace App\Http\Controllers\User\Menu\Video;

use App\Http\Controllers\Controller;
use App\Models\DataVideo;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Tampilkan semua video (dengan relasi user)
    public function index()
    {
        $video = DataVideo::with(['user']) // penting buat badge "Video Saya"
            ->latest()
            ->paginate(12);

        return view('user.menu.video_tutorial.index', compact('video'));
    }

    // AJAX Search + Pagination
    public function cariData(Request $request)
    {
        if (!$request->ajax()) abort(400);

        $query = $request->get('query', '');

        $video = DataVideo::with('user') // INI YANG WAJIB DITAMBAH!!!
            ->when($query !== '', function ($q) use ($query) {
                $q->where('judul', 'like', "%{$query}%")
                    ->orWhere('deskripsi', 'like', "%{$query}%")
                    ->orWhere('link', 'like', "%{$query}%");
            })
            ->latest()
            ->paginate(12);

        $video->appends(['query' => $query]);

        return view('user.menu.video_tutorial.components.grid', compact('video'));
    }

    // Form Tambah
    public function tampildata()
    {
        // Kalau butuh kelas/semester nanti aktifkan lagi
        // $kelas    = Kelas::all();
        // $semester = Semester::all();

        return view('user.menu.video_tutorial.tambah');
    }

    // Simpan Video Baru → WAJIB simpan user_id!
    public function tambahdata(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link'      => 'required|url',
            'fileVideo' => 'nullable|mimes:mp4,mov,avi,wmv,webm|max:102400', // max 100MB
        ]);

        $filePath = null;
        $originalName = null;

        if ($request->hasFile('fileVideo')) {
            $filePath     = $request->file('fileVideo')->store('fileVideo', 'public');
            $originalName = $request->file('fileVideo')->getClientOriginalName();
        }

        DataVideo::create([
            'judul'         => $request->judul,
            'deskripsi'     => $request->deskripsi,
            'link'          => $request->link,
            'fileVideo'     => $filePath,
            'judulFileAsli' => $originalName,
            'user_id'       => Auth::id(), // INI YANG PALING PENTING!
        ]);

        return redirect()
            ->route('user.video.index')
            ->with('success', 'Video berhasil diunggah!');
    }

    // Form Edit — hanya boleh edit punya sendiri
    public function tampiledit($kdvideo)
    {
        $video = DataVideo::where('kdvideo', $kdvideo)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        return view('user.menu.video_tutorial.edit', compact('video'));
    }

    // Update Video — hanya pemilik yang boleh
    public function editdata(Request $request, $kdvideo)
    {
        $video = DataVideo::where('kdvideo', $kdvideo)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'link'      => 'required|url',
            'fileVideo' => 'nullable|mimes:mp4,mov,avi,wmv,webm|max:102400',
        ]);

        $filePath = $video->fileVideo;

        if ($request->hasFile('fileVideo')) {
            // Hapus file lama
            if ($filePath) {
                Storage::disk('public')->delete($filePath);
            }
            $filePath = $request->file('fileVideo')->store('fileVideo', 'public');
        }

        $video->update([
            'judul'         => $request->judul,
            'deskripsi'     => $request->deskripsi,
            'link'          => $request->link,
            'fileVideo'     => $filePath,
            'judulFileAsli' => $request->hasFile('fileVideo') ? $request->file('fileVideo')->getClientOriginalName() : $video->judulFileAsli,
        ]);

        return redirect()
            ->route('user.video.index')
            ->with('success', 'Video berhasil diperbarui!');
    }

    // Hapus Video — tambahkan pengecekan pemilik
    public function hapus($kdvideo)
    {
        $video = DataVideo::where('kdvideo', $kdvideo)
            ->where('user_id', Auth::id()) // HANYA BISA HAPUS PUNYA SENDIRI
            ->firstOrFail();

        try {
            if ($video->fileVideo) {
                Storage::disk('public')->delete($video->fileVideo);
            }

            $video->delete();

            return redirect()
                ->route('user.video.index')
                ->with('success', 'Video berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()
                ->route('user.video.index')
                ->with('error', 'Gagal menghapus video.');
        }
    }
}
