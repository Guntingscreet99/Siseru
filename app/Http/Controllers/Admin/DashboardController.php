<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Ujian;
use App\Models\User;
use App\Models\DataForum;
use App\Models\DataKarya;
use App\Models\DataModul;
use App\Models\DataVideo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();

        $mahasiswaAktif = User::where('role', 'mahasiswa')
            ->where('status', 'B')
            ->count();

        $mahasiswaTidakAktif = User::where('role', 'mahasiswa')
            ->where('status', 'A')
            ->count();

        $kelas = Kelas::count();

        // ===== DATA KONTEN =====
        $totalKarya   = DataKarya::count();
        $totalModul   = DataModul::count();
        $totalVideo   = DataVideo::count();
        $totalDiskusi = DataForum::count();
       

        return view('admin.dashboard', compact(
            'totalMahasiswa',
            'mahasiswaAktif',
            'mahasiswaTidakAktif',
            'kelas',
            'totalKarya',
            'totalModul',
            'totalVideo',
            'totalDiskusi'
        ));
    }
}
