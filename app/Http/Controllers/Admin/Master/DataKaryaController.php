<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataKarya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataKaryaController extends Controller
{
    public function index()
    {
        $karya = DataKarya::all();
        // dd($karya);

        return view('admin.master.karya.index', compact('karya'));
    }

    // Cari
    public function cariData(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->input('query');

            $karya = DataKarya::where('kdkarya', 'like', "%$query%")
                ->orwhere('nama', 'like', "%$query%")
                ->orwhere('deskripsi', 'like', "%$query%")
                ->orwhere('status', 'like', "%$query%")
                ->orwhere('judulFileAsli', 'like', "%$query%")
                ->get();
            return response()->json($karya);
        }

        return redirect()->route('admin.master.karya');
    }

    // Tambah Data
    public function tampildata()
    {
        return view('admin.master.karya.tambah');
    }

    public function tambahdata(Request $request)
    {

        $request->validate(
            [
                'nama' => 'required|string|max:255',
                'fileKarya' => 'required|file|mimes:jpg,jpeg,png,mp4,mkv,avi|max:51200',
                'deskripsi' => 'nullable|string',
                'status' => 'required'
            ],
            [
                'nama.required' => 'Nama Wajib Diisi!',
                'deskripsi.required' => 'Deskripsi Wajib Diisi!',
                'fileKarya.required' => ' File Karya Wajib Diisi!',
            ]
        );

        $mdl = null;
        $judulAsli = null;

        if ($request->hasFile('fileKarya')) {
            $file = $request->file('fileKarya');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileKarya', 'public');
        }

        $data = [
            'nama' => $request->input('nama'),
            'deskripsi' => $request->input('deskripsi'),
            // 'status' => $request->input('status'),
            'fileKarya' => $mdl ?? '',
            'judulFileAsli' => $judulAsli,
        ];

        // dd($data)

        DataKarya::create($data);

        return redirect()->route('admin.master.karya')->with('success', 'Data Berhasil Ditambah');
    }

    // Edit Data
    public function tampiledit($kdkarya)
    {
        $karya = DataKarya::where('kdkarya', $kdkarya)->firstOrFail();

        return view('admin.master.karya.edit', compact('karya'));
    }

    public function editdata(Request $request, $kdkarya)
    {
        $karya = DataKarya::where('kdkarya', $kdkarya)->firstOrFail();

        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            // 'status' => 'required',
            'fileKarya' => 'required|file|mimes:jpg,jpeg,png,mp4,mkv,avi|max:51200',
        ]);

        $mdl = $karya->fileKarya;
        $judulAsli = $karya->judulFileAsli;


        if (!$request->has('gunakan_file_lama') && $request->hasFile('fileKarya')) {
            // Hapus file lama jika ada
            if ($karya->fileKarya) {
                Storage::disk('public')->delete($karya->fileKarya);
            }

            // if ($request->hasFile('fileKarya')) {
            $file = $request->file('fileKarya');
            $judulAsli = $file->getClientOriginalName();
            $mdl = $file->store('fileKarya', 'public');

            // } else {
            //     $mdl = null;
            //     $judulAsli = null;
            // }
            $karya->update([
                'fileKarya' => $mdl,
                'judulFileAsli' => $judulAsli,
            ]);


            // $file = $request->file('fileKarya');
            // $judulAsli = $file->getClientOriginalName();
            // $mdl = $file->store('fileKarya', 'public');

            // $karya->update([
            //     'fileKarya' => $mdl,
            //     'judulFileAsli' => $judulAsli,
            // ]);
        }

        $karya->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            // 'status' => $request->status,
            'fileKarya' => $mdl,
            'judulFileAsli' => $judulAsli,

            // 'nama' => $request->input('nama'),
            // 'deskripsi' => $request->input('deskripsi'),
            // 'status' => $request->input('status'),

        ]);

        return redirect()->route('admin.master.karya')->with('success', 'Data Berhasil Diperbarui');
    }

    // Hapus Data
    public function hapus($kdkarya)
    {
        $karya = DataKarya::where('kdkarya', $kdkarya)->findOrFail();

        if ($karya->fileKarya) {
            Storage::disk('public')->delete($karya->fileKarya);
        }

        $karya->delete();

        return redirect()->route('admin.master.karya')->with('success', 'Data Berhasil Dihapus');
    }

    // Status
    public function updateStatus(Request $request)
    {
        $karyaId = $request->input('kdkarya');
        $isChecked = $request->has('status') ? 'Ditampilkan' : 'Tidak Ditampilkan';

        $karya = DataKarya::findorFail($karyaId);
        $karya->status = $isChecked;
        $karya->save();

        return redirect()->back()->with('status', 'Status Berhasil Diubah!');
    }
}
