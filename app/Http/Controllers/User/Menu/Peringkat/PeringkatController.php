<?php

namespace App\Http\Controllers\User\Menu\Peringkat;

use App\Http\Controllers\Controller;
use App\Models\RekapNilai;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;

class PeringkatController extends Controller
{
    /**
     * ===============================
     * TAMPIL PERINGKAT + FILTER
     * ===============================
     */
    public function index(Request $request)
    {
        /**
         * Ambil parameter filter
         */
        $kelasId    = $request->kelas_id;
        $semesterId = $request->semester_id;

        /**
         * Data master untuk dropdown
         */
        $kelas    = Kelas::all();
        $semester = Semester::all();

        /**
         * Query dasar rekap nilai
         */
        $peringkat = RekapNilai::with(['kelas', 'semester'])
            ->when($kelasId, function ($q) use ($kelasId) {
                $q->where('id_kelas', $kelasId);
            })
            ->when($semesterId, function ($q) use ($semesterId) {
                $q->where('id_semester', $semesterId);
            })
            ->get();

        /**
         * Urutkan berdasarkan nilai akhir (ACCESSOR)
         */
        $peringkat = $peringkat
            ->sortByDesc(fn($item) => $item->nilai_angka)
            ->values();

        /**
         * Hitung ranking (aman untuk nilai sama)
         */
        $rank = 1;
        $lastScore = null;

        $peringkat->transform(function ($item, $index) use (&$rank, &$lastScore) {
            if ($lastScore !== null && $item->nilai_angka < $lastScore) {
                $rank = $index + 1;
            }

            $item->peringkat = $rank;
            $lastScore = $item->nilai_angka;

            return $item;
        });

        /**
         * Kirim ke view
         */
        return view('user.menu.peringkat.index', compact(
            'peringkat',
            'kelas',
            'semester'
        ));
    }
}
