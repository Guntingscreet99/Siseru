<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\DataPerpustakaan;
use Illuminate\Http\Request;

class DataPerpustakaanController extends Controller
{
    public function index(){
        $perpustakaan = DataPerpustakaan::all();
        return view('admin.master.perpustakaan.index', compact('perpustakaan'));
    }

    public function tambah(Request $request)
    {
        // Validasai imput data di modal
        $request->validate([
            'judulbuku' => 'required|max:225',
            'kategoribuku' => 'required|max:225',
            'judulmodul' => 'required|max:225',
            'kategorimodul' => 'required|max:225',
            'judulartikel' => 'required|max:225',
            'kategoriartikel' => 'required|max:225',
        ],[
            'judulbuku.required' => 'Judul Buku Harus Diisi!.',
            'kategoribuku.required' => 'Kategori Buku Harus Diisi!.',
            'judulmodul.required' => 'Judul Modul Harus Diisi!.',
            'kategorimodul.required' => 'Kategori Modul Harus Diisi!.',
            'judulartikel.required' => 'Judul Artikel Harus Diisi!.',
            'kategoriartikel.required' => 'Kategori Artikel Harus Diisi!.',

        ]);

        $data = [
            'judulbuku' => $request->judulbuku,
            'kategoribuku' => $request->kategoribuku,
            'judulmodul' => $request->judulmodul,
            'kategorimodul' => $request->kategorimodul,
            'judulartikel' => $request->judulartikel,
            'kategoriartikel' => $request->kategoriartikel,
        ];

        // dd($data);

        DataPerpustakaan::create($data);
        return redirect()->route('dataperpustakaan.index')->with('success', 'Data Berhasil Ditambah!.');
    }

//Edit
    public function edit(Request $request, $id)
        {
            $data = [
                'judulbuku' => $request->judulbuku,
                'kategoribuku' => $request->kategoribuku,
                'judulmodul' => $request->judulmodul,
                'kategorimodul' => $request->kategorimodul,
                'judulartikel' => $request->judulartikel,
                'kategoriartikel' => $request->kategoriartikel,
            ];

            Dataperpustakaan::find($id)->update($data);

            return redirect()->route('admin.master.perpustakaan')->with('success','Data Berhasil Diedit!.');
        }

// Hapus
    public function hapus ($id)
    {
        DataPerpustakaan::destroy($id);
        return redirect()->route('dataperpustakaan.index')->with('success','Data Berhasil Disimpan!.');
    }
}

