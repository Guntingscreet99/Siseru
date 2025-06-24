<?php

namespace App\Http\Controllers\Admin\Master\Utama;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $entries = $request->input('entries', 10);
        $page = $request->input('page', 1);

        $query = Kelas::orderBy('id', 'asc');

        if ($search) {
            $query->where('nama_kelas', 'LIKE', "%{$search}%");
        }

        $kelas = $query->paginate($entries, ['*'], 'page', $page);
        $kelas->append(['search' => $search, 'entries' => $entries]);

        return view('admin.master.kelas.index', compact('search', 'entries', 'kelas'));
    }

    public function tambah(Request $request)
    {
        $data = [
            'nama_kelas' => $request->nama_kelas,
        ];

        Kelas::create($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil ditambah!.');
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'nama_kelas' => $request->nama_kelas,
        ];

        Kelas::findOrFail($id)->update($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil diubah!.');
    }

    public function hapus($id)
    {
        Kelas::destroy($id);

        return redirect()->route('admin.kelas.index')->with('success', 'Data berhasil dihapus!.');
    }
}
