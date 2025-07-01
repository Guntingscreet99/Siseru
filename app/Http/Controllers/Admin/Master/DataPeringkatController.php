<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataPeringkat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPeringkatController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->input('cari');
        $halaman = $request->input('halaman', 10);
        $page = $request->input('page', 1);

        $query = DataPeringkat::orderBy('id', 'asc');

        if ($cari) {
            $query->where('skor', 'LIKE', "%{$cari}%")
                ->orWhere('rangking', 'LIKE', "%{$cari}%")
                ->orWhere('status', 'LIKE', "%{$cari}%");
        }

        $peringkat = $query->paginate($halaman, ['*'], 'page', $page);
        $peringkat->append(['cari' => $cari, 'halaman' => $halaman]);


        return view('admin.master.peringkat.index', compact('peringkat'));
    }



    // public function cari(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $query = $request->input('query');

    //         $peringkat = DataPeringkat::where('id', 'like', "%$query%")
    //             ->orWhere('skor', 'like', "%$query%")
    //             ->orWhere('ranking', 'like', "%$query%")
    //             ->orWhere('status', 'like', "%$query%")
    //             ->get();

    //         return response()->json($peringkat);
    //     }

    //     return redirect()->route('admin.master.peringkat');
    // }

    // Tambah Data
    public function tampildata()
    {
        return view('admin.master.peringkat.tambah');
    }

    public function tambahdata(Request $request)
    {
        $request->validate([
            'skor' => 'required',
            'ranking' => 'required',
            'status' => 'required',
        ], [
            'skor.required' => 'Skor Wajib Diisi!.',
            'ranking.required' => 'Skor Wajib Diisi!.',
        ]);

        $data = [
            'skor' => $request->skor,
            'ranking' => $request->ranking,
            'status' => $request->status,
        ];

        DataPeringkat::create($data);
        return redirect()->route('admin.master.peringkat')->with('success', 'Data Berhasil Ditambah');
    }

    // edit
    public function tampiledit($kdperingkat)
    {
        $peringkat = DataPeringkat::where('kdperingkat', $kdperingkat)->firstOrFail();
        return view('admin.master.peringkat.edit', compact('peringkat'));
    }

    public function editdata(Request $request, $kdperingkat)
    {
        $request->validate([
            'skor' => 'required',
            'ranking' => 'required',
            'status' => 'required',
        ]);

        $peringkat = DataPeringkat::where('kdperingkat', $kdperingkat)->firstOrFail();

        $data = [
            'skor' => $request->skor,
            'ranking' => $request->ranking,
            'status' => $request->status,
        ];

        $peringkat->update($data);

        return redirect()->route('admin.master.peringkat')->with('success', 'Data Berhasil Ditambah');
    }

    // hapus

    public function hapus($kdperingkat)
    {
        $peringkat = DataPeringkat::where('kdperingkat', $kdperingkat)->firstOrfail();

        $peringkat->delete();

        return redirect()->route('admin.master.peringkat')->with('success', 'Data Berhasil Dihapus!.');
    }

    // // Status
    // public function updateStatus(Request $request)
    // {
    //     $perpusId = $request->input('kdperpus');
    //     $isChecked = $request->has('status') ? 'Ditampilkan' : 'Tidak Ditampilkan';

    //     $perpus = DataPerpustakaan::findorFail($perpusId);
    //     $perpus->status = $isChecked;
    //     $perpus->save();

    //     return redirect()->back()->with('status', 'Status Berhasil Diubah');
    // }
}
