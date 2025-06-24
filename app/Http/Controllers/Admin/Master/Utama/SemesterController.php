<?php

namespace App\Http\Controllers\Admin\Master\Utama;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use Illuminate\Http\Request;

class SemesterController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $entries = $request->input('entries', 10);
        $page = $request->input('page', 1);

        $query = Semester::orderBy('id', 'asc');

        if ($search) {
            $query->where('nama_semester', 'LIKE', "%{$search}%")
                ->orWhere('periode', 'LIKE', "%{$search}%");
        }

        $semester = $query->paginate($entries, ['*'], 'page', $page);
        $semester->append(['search' => $search, 'entries' => $entries]);

        return view('admin.master.semester.index', compact('search', 'entries', 'semester'));
    }

    public function tambah(Request $request)
    {
        $data = [
            'nama_semester' => $request->nama_semester,
            'periode' => $request->periode,
        ];

        Semester::create($data);

        return redirect()->route('admin.semester.index')->with('success', 'Data berhasil ditambah!.');
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'nama_semester' => $request->nama_semester,
            'periode' => $request->periode,
        ];

        Semester::findOrFail($id)->update($data);

        return redirect()->route('admin.semester.index')->with('success', 'Data berhasil diubah!.');
    }

    public function hapus($id)
    {
        Semester::destroy($id);

        return redirect()->route('admin.semester.index')->with('success', 'Data berhasil dihapus!.');
    }
}
