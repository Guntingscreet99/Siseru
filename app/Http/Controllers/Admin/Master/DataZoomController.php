<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\models\DataZoom;
use App\Models\Kelas;
use App\Models\Semester;
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
        $kelas = Kelas::all();

        return view('admin.master.zoom.tambah', compact('kelas'));
    }

    public function tambahdata(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'linkZoom' => 'nullable',
            'linkWebinar' => 'nullable',
            'status' => 'required',
        ], [
            'id_kelas.required' => 'Kelas Wajib Diisi!',
            'status.required' => 'Status Wajib Diisi!',
        ]);

        DataZoom::create([
            'id_kelas' => $request->id_kelas,
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

        $kelas = Kelas::all();

        return view('admin.master.zoom.edit', compact('zoom', 'kelas'));
    }

    public function editdata(Request $request, $kdzoom)
    {
        $zoom = DataZoom::where('kdzoom', $kdzoom)->firstOrFail();

        $request->validate([
            'id_kelas' => 'required',
            'linkZoom' => 'nullable',
            'linkWebinar' => 'nullable',
            'status' => 'required',
        ]);

        $zoom->update([
            'id_kelas' => $request->id_kelas,
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
