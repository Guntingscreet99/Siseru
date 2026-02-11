<?php

namespace App\Http\Controllers\User\Menu\Modul;

use App\Http\Controllers\Controller;
use App\Models\DataModul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ModulController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // ========================================
    // INDEX + LIVE SEARCH
    // ========================================
    public function index(Request $request)
    {

        $query = $request->input('query');

        $modul = DataModul::with(['kelas', 'semester', 'user'])
            ->when($query, function ($q) use ($query) {
                return $q->where('judul', 'like', "%{$query}%")
                    ->orWhere('topik', 'like', "%{$query}%")
                    ->orWhere('tahun', 'like', "%{$query}%")
                    ->orWhereHas('kelas', fn($qq) => $qq->where('nama_kelas', 'like', "%{$query}%"))
                    ->orWhereHas('semester', fn($qq) => $qq->where('nama_semester', 'like', "%{$query}%"));
            })
            ->latest()
            ->paginate(20);

        if ($request->ajax()) {
            return view('user.menu.modul.components.grid', compact('modul'))->render();
        }

        return view('user.menu.modul.index', compact('modul'));
    }

    // ========================================
    // FORM TAMBAH MODUL
    // ========================================
    public function tampildata()
    {
        return view('user.menu.modul.tambah');
    }

    public function tambahdata(Request $request)
    {

        $user = Auth::user();

        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|digits:4|integer',
            'topik'     => 'nullable|string',
            'fileModul' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,mp4,jpg,jpeg,png,gif,webp|max:51200', // max 50MB
        ]);

        $file = $request->file('fileModul');

        $folder = 'uploads/fileModul';

        $namaFile = time().'_'.$file->getClientOriginalName();

        $file->move(public_path($folder), $namaFile);

        $path = $folder.'/'.$namaFile;

        $idKelas = $request->id_kelas;
                // dari form (user bisa pilih beda kalau mau)
        $idSemester = $request->id_semester;

        // dd($idKelas, $idSemester);

        DataModul::create([
            'user_id'       => $user->id,
            'id_kelas'      => $idKelas,     // otomatis dari profil user
            'id_semester'   => $idSemester,    // otomatis dari profil user
            'judul'         => $request->judul,
            'tahun'         => $request->tahun,
            'topik'         => $request->topik,
            'fileModul'     => $path,
            'judulFileAsli' => $file->getClientOriginalName(),
        ]);

        return redirect()
            ->route('user.modul.index')
            ->with('success', 'Modul berhasil diunggah!');
    }

    // ========================================
    // FORM EDIT (HANYA PEMILIK SAJA)
    // ========================================
    public function tampiledit($kdmodul)
    {
        $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

        if ($modul->user_id !== Auth::id()) {
            return redirect()->route('user.modul.index')->with('error', 'Kamu tidak punya akses!');
        }

        return view('user.menu.modul.edit', compact('modul'));
    }

    // ========================================
    // UPDATE MODUL
    // ========================================
    public function editdata(Request $request, $kdmodul)
    {
        $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

        if ($modul->user_id !== Auth::id()) {
            return redirect()->route('user.modul.index')->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'judul'     => 'required|string|max:255',
            'tahun'     => 'required|digits:4',
            'topik'     => 'nullable|string',
            'fileModul' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx,mp4,jpg,jpeg,png,gif,webp|max:51200',
        ]);

        $path = $modul->fileModul;
        $namaAsli = $modul->judulFileAsli;

        if ($request->hasFile('fileModul')) {
            // Hapus file lama (kalau ada)
            if ($modul->fileModul && file_exists(public_path($modul->fileModul))) {
                unlink(public_path($modul->fileModul));
            }

            // Upload file baru
            $file = $request->file('fileModul');

            $folder = 'uploads/fileModul';

            $namaBaru = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

            $file->move(public_path($folder), $namaBaru);

            // Path untuk database
            $path = $folder.'/'.$namaBaru;

            $namaAsli = $file->getClientOriginalName();
        }


        $modul->update([
            'judul'         => $request->judul,
            'tahun'         => $request->tahun,
            'topik'         => $request->topik,
            'fileModul'     => $path,
            'judulFileAsli' => $namaAsli,
            // id_kelas & id_semester tidak diubah karena sudah dari profil
        ]);

        return redirect()->route('user.modul.index')->with('success', 'Modul berhasil diperbarui!');
    }

    // ========================================
    // HAPUS MODUL (HANYA PEMILIK)
    // ========================================
    public function hapus($kdmodul)
    {
        $modul = DataModul::where('kdmodul', $kdmodul)->firstOrFail();

        if ($modul->user_id !== Auth::id()) {
            return redirect()->route('user.modul.index')->with('error', 'Kamu bukan pemilik modul ini!');
        }

        // Hapus file fisik
        if ($modul->fileModul && Storage::disk('public')->exists($modul->fileModul)) {
            Storage::disk('public')->delete($modul->fileModul);
        }

        $modul->delete();

        return redirect()->route('user.modul.index')->with('success', 'Modul berhasil dihapus!');
    }
}
