<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataUjianController extends Controller
{
    public function index()
    {
        // dd($ujians = Ujian::all());

        $ujians = Ujian::with('kelas', 'semester')
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        // dd($ujians);

        return view('admin.master.ujian.index', compact('ujians'));
    }

    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->get('query');

            $ujians = Ujian::where(function ($q) use ($query) {
                $q->where('ujian', 'like', "%{$query}%")
                    ->orWhere('kelas', 'like', "%{$query}%")
                    ->orWhere('semester', 'like', "%{$query}%")
                    ->orWhere('status', 'like', "%{$query}%");
            })
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json($ujians);
        }

        return redirect()->route('admin.ujian.index');
    }

    public function tampildata()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.ujian.tambah', compact('kelas', 'semester'));
    }

    public function tambahdata(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'ujian'    => 'required|string|max:255',
            'link'     => 'nullable|url',
            'id_kelas'    => 'required',
            'id_semester' => 'required',
            'durasi_menit' => 'nullable|integer|min:1',
            'waktu_mulai'  => 'nullable|date',
        ]);

        Ujian::create([
            'ujian'         => $request->ujian,
            'link'          => $request->link,
            'id_kelas'         => $request->id_kelas,
            'id_semester'      => $request->id_semester,
            'durasi_menit'  => $request->durasi_menit,
            'waktu_mulai'   => $request->waktu_mulai,
            'status'        => 'Ditampilkan',
        ]);

        return redirect()
            ->route('admin.ujian.index')
            ->with('success', 'Ujian berhasil ditambahkan');
    }


    public function tampiledit(Ujian $ujian)
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('admin.master.ujian.edit', compact('ujian', 'kelas', 'semester'));
    }

    public function editdata(Request $request, Ujian $ujian)
    {
        $request->validate([
            'ujian'        => 'required|string|max:255',
            'link'         => 'nullable|url',
            'id_kelas'        => 'required|exists:kelas,id_kelas',
            'id_semester'     => 'required|exists:semesters,id_semester',
            'waktu_mulai'  => 'nullable|date',
            'durasi_menit' => 'nullable|integer|min:1',
        ]);

        $ujian->update([
            'ujian'        => $request->ujian,
            'link'         => $request->link,
            'id_kelas'        => $request->id_kelas,
            'id_semester'     => $request->id_semester,
            'waktu_mulai'  => $request->waktu_mulai,
            'durasi_menit' => $request->durasi_menit,
        ]);

        return redirect()
            ->route('admin.ujian.index')
            ->with('success', 'Ujian berhasil diperbarui.');
    }

    public function hapus(Ujian $ujian)
    {
        if ($ujian->file_ujian && Storage::disk('public')->exists($ujian->file_ujian)) {
            Storage::disk('public')->delete($ujian->file_ujian);
        }

        $ujian->delete();

        return redirect()
            ->route('admin.ujian.index')
            ->with('success', 'Ujian berhasil dihapus.');
    }

    public function updateStatus(Request $request)
    {
        $ujian = Ujian::findOrFail($request->kdujian);
        $ujian->status = $request->has('status') ? 'Ditampilkan' : 'Tidak Ditampilkan';
        $ujian->save();

        return redirect()->back()->with('success', 'Status berhasil diubah.');
    }
}
