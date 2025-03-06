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
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'link' => 'required',
            'fileVideo' => 'nullable|file|mimes:mp4,mkv,avi|max:51.200',
        ],[
            'judul.required' => 'Judul Wajib Diisi!',
            'deskripsi.required' => 'Deskripsi Wajib Diisi!',
            'Link.required' => 'Link Wajib Diisi!',
            'judul.required' => 'Judul Wajib Diisi!',

        ]);

        $md1 = null;
        $judulAsli = null;

        if($request->hasFile('fileVideo')){
            $file = $request->file('fileVideo');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileVideo', 'public');
        }

        DataVideo::create([
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'link' => $request->input('link'),
            'fileVideo' => $mdl,
            'judulFileAsli' => $judulAsli,
        ]);

        return redirect()->route('admin.master.video')->with('success', 'Data Berhasil Ditambah');
    }
}
