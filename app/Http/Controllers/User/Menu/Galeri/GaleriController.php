<?php

namespace App\Http\Controllers\User\Menu\Galeri;

use App\Http\Controllers\Controller;
use App\Models\DataKarya;
use App\Models\Kelas;
use App\Models\Semester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $karya = DataKarya::with(['kelas', 'semester', 'user'])->latest()->paginate(12);
        return view('user.menu.galeri_karya.index', compact('karya'));
    }

    public function cariData(Request $request)
    {
        if (!$request->ajax()) abort(400);

        $query = $request->get('query', '');

        $karya = DataKarya::with(['kelas', 'semester', 'user'])
            ->when($query !== '', function ($q) use ($query) {
                $q->where('namaKarya', 'like', "%{$query}%")
                    ->orWhere('namaMhs', 'like', "%{$query}%")
                    ->orWhereHas('kelas', fn($sq) => $sq->where('nama_kelas', 'like', "%{$query}%"))
                    ->orWhereHas('semester', fn($sq) => $sq->where('nama_semester', 'like', "%{$query}%"));
            })
            ->latest()
            ->paginate(12);

        $karya->appends(['query' => $query]);

        // Pakai partial biasa – tidak pakai fragment lagi
        return view('user.menu.galeri_karya.components.grid', compact('karya'));
    }

    // TAMBAH DATA
    public function tampildata()
    {
        $user = User::with('datadiri')->find(Auth::id());

        // dd($user);

        return view('user.menu.galeri_karya.tambah', compact('user'));
    }

    public function tambahdata(Request $request)
    {
        // dd($request->all());

        $user = Auth::user();

        $request->validate([
            'namaKarya'    => 'required|string|max:255',
            'id_kelas'     => 'required|exists:kelas,id',
            'id_semester'  => 'required|exists:semesters,id',
            'deskripsi'    => 'required|string',
            'fileKarya'    => 'required|file|mimes:jpg,jpeg,png,gif,mp4,mkv,avi|max:51200',
        ]);

        // Ambil data dari DataDiri (yang pasti lengkap)
        $dataDiri = $user->datadiri; // relasi hasOne

        $namaMhs = $dataDiri?->nama_lengkap ?? $user->username ?? 'Mahasiswa';
        // $nim     = $dataDiri?->nim ?? null;
        $idKelas = $request->id_kelas;        // dari form (user bisa pilih beda kalau mau)
        $idSemester = $request->id_semester;  // dari form

        $file = $request->file('fileKarya');

        $namaFile = time() . '_' . $file->getClientOriginalName();

        $path = public_path('uploads/fileKarya');

        $file->move($path, $namaFile);

        DataKarya::create([
            'user_id'       => $user->id,
            'namaMhs'       => $namaMhs,
            'nim'           => $user->nim ?? null,
            'namaKarya'     => $request->namaKarya,
            'id_kelas'      => $idKelas,
            'id_semester'   => $idSemester,
            'deskripsi'     => $request->deskripsi,
            'fileKarya'     => $path,
            'judulFileAsli' => $file->getClientOriginalName(),
        ]);

        return redirect()->route('user.galeri.index')
            ->with('success', 'Karya berhasil diunggah!');
    }

    // EDIT - Tampil Form
    public function tampiledit($kdkarya)
    {
        $karya = DataKarya::where('kdkarya', $kdkarya)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('user.menu.galeri_karya.edit', compact('karya', 'kelas', 'semester'));
    }

    // EDIT - Proses Update
    public function editdata(Request $request, $kdkarya)
    {
        $karya = DataKarya::where('kdkarya', $kdkarya)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $request->validate([
            'namaKarya'     => 'required|string|max:255',
            'id_kelas'      => 'required|exists:kelas,id',
            'id_semester'   => 'required|exists:semesters,id',
            'deskripsi'     => 'required|string',
            'fileKarya'     => 'nullable|file|mimes:jpg,jpeg,png,mp4,mkv,avi|max:51200',
        ]);

        $data = $request->only(['namaKarya', 'id_kelas', 'id_semester', 'deskripsi']);

        if ($request->hasFile('fileKarya')) {
            // Hapus file lama
            if ($karya->fileKarya && Storage::disk('public')->exists($karya->fileKarya)) {
                Storage::disk('public')->delete($karya->fileKarya);
            }

            $file = $request->file('fileKarya');

            $data['judulFileAsli'] = $file->getClientOriginalName();
            $namafile = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

            $file->move(
                public_path('uploads/fileKarya'),
                $namafile
            );

            $data['fileKarya'] = 'uploads/fileKarya/' . $namafile;
        }

        $karya->update($data);

        return redirect()->route('user.galeri.index')
            ->with('success', 'Karya berhasil diperbarui!');
    }

    // HAPUS
    public function hapus($kdkarya)
    {
        $karya = DataKarya::where('kdkarya', $kdkarya)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // dd($karya);

        if ($karya->fileKarya && Storage::disk('public')->exists($karya->fileKarya)) {
            Storage::disk('public')->delete($karya->fileKarya);
        }

        $karya->delete();

        return redirect()->route('user.galeri.index')
            ->with('success', 'Karya berhasil dihapus permanen.');
    }
}
