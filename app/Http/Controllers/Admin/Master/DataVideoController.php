<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataVideo;
use Illuminate\Http\Request;

class DataVideoController extends Controller
{
    public function index(){
        $video = DataVideo::all();

        return view('admin.master.video.index', compact('video'));
    }

    // cari
    public function cariData(Request $request){
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

        return redirect()->route('admin.master.video');
    }

    // tambah
    public function tampiltambah(){
        return view('admin.master.video.tambah');
    }

    public function tambahData(Request $request){

        // dd($request->all());

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'fileVideo' => 'nullable|mimes:mp4,mkv,avi',
        ],[
            [
                'judul.required' => 'Judul Wajib Diisi!',
                'deskripsi.required' => 'Deskripsi Wajib Diisi!',
                'link.required' => 'Link Wajib Diisi!',
                'fileVideo.reqquired' => 'FileVideo Wajib Diisi!',
            ]

        ]);

        $mdl = null;
        $judulAsli = null;

        if($request->hasFile('fileVideo')){
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

        return redirect()->route('admin.master.video')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdvideo){
        $video = DataVideo::where('kdvideo', $kdvideo)->firstOrFail();

        return view('admin.master.video.edit', compact('video'));
    }

    public function editData(Request $request, $kdvideo){
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'fileVideo' => 'nullable|mimes:mp4,mkv,avi',
        ]);

        $video = DataVideo::where('kdvideo', $kdvideo)->firstOrFail();

        // Cek apakah pengguna ingin menggunakan file lama atau mengganti dengan yang baru
        if(!$request->has('gunakan_file_lama') && $request->hasFile('fileVideo')){
            // Hapus file lama jika ada
            if ($video->fileVideo) {
                \Storage::disk('public')->delete($video->fileVideo);
            }

            $file = $request->file('fileVideo');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileVideo', 'public');

            $video->update([
                'fileVideo' => $mdl,
                'judulFileAsli' => $judulAsli,
            ]);
        }

        $video->update([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link' => $request->input('link'),
        ]);

        return redirect()->route('admin.master.video')->with('success', 'Data Berhasil Diperbarui');
    }

    // Hapus Data
    public function hapus($kdvideo){
        $video = DataVideo::where('kdvideo', $kdvideo)->firstOrFail(); // Ambil satu objek, bukan koleksi

        return view('admin.master.video.hapus', compact('video'));

        // Hapus file video dari storage jika ada
        if ($video->fileVideo) {
            \Storage::disk('public')->delete($video->fileVideo);
        }

        // Hapus data dari database
        $video->delete();

        return redirect()->route('admin.master.video')->with('success', 'Data Berhasil Dihapus');

        }

}
