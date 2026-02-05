<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use Illuminate\Http\Request;

class DataTestimoniController extends Controller
{
    // List semua testimoni
    public function index()
    {
        $testimonis = Testimoni::with('user.dataDiri')
            ->latest()
            ->get();

        return view('admin.master.testimoni.index', compact('testimonis'));
    }

    // Setujui / tampilkan
    public function approve($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->update(['status' => 1]);

        // dd($testimoni);
        return back()->with('success', 'Testimoni ditampilkan.');
    }

    // Sembunyikan
    public function reject($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->update(['status' => 0]);

        return back()->with('success', 'Testimoni disembunyikan.');
    }

    // Hapus permanen
    public function destroy($id)
    {
        Testimoni::findOrFail($id)->delete();
        return back()->with('success', 'Testimoni dihapus.');
    }
}
