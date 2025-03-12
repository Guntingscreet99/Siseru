<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\models\DataZoom;
use Illuminate\Http\Request;

class DataZoomController extends Controller
{
    // data
    public function index(){
        $zoom = DataZoom::all();
        return view('admin.master.zoom.index', compact('zoom'));
    }

    // cari
    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request-> input('query');

            $zoom = DataZoom::Where('id', 'like',"%$query%")
                        ->orWhere('kelas', 'like', "%$query%")
                        ->orWhere('link', 'like', "%$query%")
                        ->get();
            return response()->json($zoom);
        }

        return redirect()->route('admin.master.zoom');
    }

    // tambah
    public function tampildata(){
        return view('admin.master.zoom.tambah');
    }

    public function tambahdata(Request $request){
        $request->validate([
            'kelas' => 'required',
            'link' => 'required',
        ],[
            'kelas.required' => 'Kelas Wajib Diisi!',
            'link.required' => 'link Wajib Diisi!',
        ]);

        DataZoom::create([
            'kelas' => $request->input('kelas'),
            'link' => $request->input('link'),
        ]);

        return redirect()->route('admin.master.zoom')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdzoom){
        $zoom = DataZoom::where('kdzoom', $kdzoom)->firstOrFail();
        return view('admin.master.zoom.edit', compact('zoom'));
    }

    public function editdata(Request $request, $kdzoom){
        $zoom = DataZoom::where('kdzoom', $kdzoom)->firstOrFail();

        $request->validate([
            'kelas' => 'required',
            'link' => 'required',
        ]);

        $zoom->update([
            'kelas' => $request->kelas,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.master.zoom')->with('success', 'Data Berhasil Diubah');
    }

    // Hapus
    public function hapus($kdzoom){
        // dd($kdzoom);
        $zoom = DataZoom::where('kdzoom', $kdzoom)->firstOrFail();

        $zoom->delete();

        return redirect()->route('admin.master.zoom')->with('success', 'Data Berhasil Dihapus');
    }
}
