<?php

namespace App\Http\Controllers\User\Menu\Video;

use App\Http\Controllers\Controller;
use App\Models\DataVideo;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    public function index()
    {
        $video = DataVideo::all();

        return view('user.menu.video_tutorial.index', compact('video'));
    }

    // Cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $video = DataVideo::where('kdvideo', 'like', "%$query%")
                ->orWhere('judul', 'like', "%$query%")
                ->orWhere('deskripsi', 'like', "%$query%")
                ->orWhere('link', 'like', "%$query%")
                ->orWhere('judulFileAsli', 'like', "%$query%")
                ->get();

            return response()->json($video);
        }

        return redirect()->route('user.video.index');
    }

    // Tambah Data
    public function tampildata()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.video_tutorial.tambah', compact('kelas', 'semester'));
    }

    public function tambahdata(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'fileVideo' => 'file|max:51200',
        ], [
            'judul.required' => 'Judul Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'link.required' => 'link Tidak Wajib Diisi!',
            'fileVideo.required' => 'FileVideo Wajib Diisi!',
        ]);

        $mdl = null;
        $judulAsli = null;

        if ($request->hasFile('fileVideo')) {
            $file = $request->file('fileVideo');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileVideo', 'public');
        }

        $data = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link' => $request->input('link'),
            'fileVideo' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        // dd($data);

        DataVideo::create($data);

        return redirect()->route('user.video.index')->with('success', 'Data Berhasil Ditambah');
    }


    // Edit Data
    public function tampiledit($kdvideo)
    {
        $video = DataVideo::findOrFail($kdvideo);

        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.video_tutorial.edit', compact('video', 'kelas', 'semester'));
    }

    public function editdata(Request $request, $kdvideo)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'fileVideo' => 'file|max:51200',
        ], [
            'judul.required' => 'Judul Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'link.required' => 'link Tidak Wajib Diisi!',
            'fileVideo.required' => 'FileVideo Wajib Diisi!',
        ]);

        $video = DataVideo::findOrFail($kdvideo);

        $mdl = $video->fileVideo;
        $judulAsli = $video->judulFileAsli;

        if ($request->hasFile('fileVideo')) {
            // Hapus file lama jika ada
            if ($mdl) {
                Storage::disk('public')->delete($mdl);
            }

            $file = $request->file('fileVideo');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileVideo', 'public');
        }

        $video->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link' => $request->input('link'),
            'fileVideo' => $mdl,
            'judulFileAsli' => $judulAsli,
        ]);

        return redirect()->route('user.video.index')->with('success', 'Data Berhasil Diubah');
    }

    // Hapus Data
    public function hapus($kdvideo)
    {
        try {
            $video = DataVideo::where('kdvideo', $kdvideo)->firstOrFail();

            if ($video->fileVideo) {
                Log::info('File to be deleted: ' . $video->fileVideo);
                if (Storage::disk('public')->delete($video->fileVideo)) {
                    Log::info('File exits, attempting to delete');
                    $deleted = Storage::disk('public')->delete($video->fileVideo);
                    Log::info('Deletion result: ' . ($deleted ? 'Success' : 'Failed'));
                } else {
                    Log::warning('File does not exist in storage: ' . $video->fileVideo);
                }
            } else {
                Log::warning('No fileVideo found for kdvideo: ' . $kdvideo);
            }

            $video->delete();

            return redirect()->route('user.video.index')->with('success', 'Data Berhasil Dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting video: ' . $e->getMessage());
            return redirect()->route('user.video.index')->with('error', 'Gagal menghapus data atau file. Silahkan coba lagi.');
        }
    }
}
