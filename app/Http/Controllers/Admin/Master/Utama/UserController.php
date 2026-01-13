<?php

namespace App\Http\Controllers\Admin\Master\Utama;

use App\Http\Controllers\Controller;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $entries = $request->input('entries', 10);
        $page = $request->input('page', 1);

        $query = User::orderBy('id', 'asc')
            ->where('role', 'mahasiswa');

        if ($search) {
            $query->where('nama_mahasiswa', 'LIKE', "%{$search}%")
                ->orWhere('nim', 'LIKE', "%{$search}%")
                ->orWhere('jenisKelamin', 'LIKE', "%{$search}%");
        }

        $mahasiswa = $query->paginate($entries, ['*'], 'page', $page);
        $mahasiswa->append(['search' => $search, 'entries' => $entries]);

        // dd($mahasiswa);

        return view('admin.master.user.index', compact('search', 'mahasiswa', 'entries'));
    }

    public function tambah(Request $request)
    {
        $data = [
            'nama_mahasisawa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'jenisKelamin' => $request->jenisKelamin,
        ];

        User::create($data);

        return redirect()->route('admin.user.index')->with('success', 'Data Berhasil Ditambah!.');
    }

    public function edit(Request $request, $id)
    {
        $data = [
            'nama_mahasisawa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'jenisKelamin' => $request->jenisKelamin,
        ];

        User::findOrFail($id);
    }
}
