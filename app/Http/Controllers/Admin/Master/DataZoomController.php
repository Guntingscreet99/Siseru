<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\models\DataZoom;
use Illuminate\Http\Request;

class DataZoomController extends Controller
{
    // data
    public function index()
    {
        $zoom = DataZoom::all();
        return view('admin.master.zoom.index', compact('zoom'));
    }

    // cari
    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $zoom = DataZoom::Where('id', 'like', "%$query%")
                ->orWhere('kelas', 'like', "%$query%")
                ->orWhere('linkZoom', 'like', "%$query%")
                ->orWhere('linkWebinar', 'like', "%$query%")
                ->orWhere('status', 'like', "%$query%")
                ->get();
            return response()->json($zoom);
        }

        return redirect()->route('admin.master.zoom');
    }

    // tambah
    public function tampildata()
    {
        return view('admin.master.zoom.tambah');
    }

    public function tambahdata(Request $request)
    {
        $request->validate([
            'kelas' => 'required',
            'linkZoom' => 'required',
            'linkWebinar' => 'required',
            'status' => 'required',
        ], [
            'kelas.required' => 'Kelas Wajib Diisi!',
            'status.required' => 'Status Wajib Diisi!',
        ]);

        DataZoom::create([
            'kelas' => $request->input('kelas'),
            'linkZoom' => $request->input('linkZoom'),
            'linkWebinar' => $request->input('linkWebinar'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.master.zoom')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdzoom)
    {
        $zoom = DataZoom::where('kdzoom', $kdzoom)->firstOrFail();
        return view('admin.master.zoom.edit', compact('zoom'));
    }

    public function editdata(Request $request, $kdzoom)
    {
        $zoom = DataZoom::where('kdzoom', $kdzoom)->firstOrFail();

        $request->validate([
            'kelas' => 'required',
            'linkZoom' => 'required',
            'linkWebinar' => 'required',
            'status' => 'required',
        ]);

        $zoom->update([
            'kelas' => $request->kelas,
            'linkZoom' => $request->linkZoom,
            'linkWebinar' => $request->linkWebinar,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.master.zoom')->with('success', 'Data Berhasil Diubah');
    }

    // Hapus
    public function hapus($kdzoom)
    {
        // dd($kdzoom);
        $zoom = DataZoom::where('kdzoom', $kdzoom)->firstOrFail();

        $zoom->delete();

        return redirect()->route('admin.master.zoom')->with('success', 'Data Berhasil Dihapus');
    }

    // Status
    public function updateStatus(Request $request)
    {
        $zoomId = $request->input('kdzoom');
        $isChecked = $request->has('status') ? 'Ditampilkan' : 'Tidak Ditampilkan';

        $zoom = DataZoom::findOrFail($zoomId);
        $zoom->status = $isChecked;
        $zoom->save();

        return redirect()->back()->with('status', 'Status Berhasil Diubah!');
    }
}
