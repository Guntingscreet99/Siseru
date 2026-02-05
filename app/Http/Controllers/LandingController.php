<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kelas;
use App\Models\DataKarya;
use App\Models\DataModul;
use App\Models\DataVideo;
use App\Models\DataForum;
use App\Models\Testimoni;

class LandingController extends Controller
{
    public function index()
    {
        // MAHASISWA
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $mahasiswaAktif = User::where('role', 'mahasiswa')->where('status', 'B')->count();
        $mahasiswaTidakAktif = User::where('role', 'mahasiswa')->where('status', 'A')->count();
        $karya = DataKarya::orderBy('total_nilai', 'DESC')->limit(3)->get();

        // KELAS
        $kelas = Kelas::count();

        // KONTEN
        $totalKarya   = DataKarya::count();
        $totalModul   = DataModul::count();
        $totalVideo   = DataVideo::count();
        $totalDiskusi = DataForum::count();

        $testimonis = Testimoni::with('user.dataDiri')
            ->where('status', 1)
            ->latest()
            ->take(10)
            ->get();

        // Kirim ke view
        return view('landing', compact(
            'totalMahasiswa',
            'mahasiswaAktif',
            'mahasiswaTidakAktif',
            'kelas',
            'totalKarya',
            'totalModul',
            'totalVideo',
            'totalDiskusi',
            'karya',
            'testimonis'
        ));
    }

    public function dosen()
    {
        return view('dosen');
    }
}
