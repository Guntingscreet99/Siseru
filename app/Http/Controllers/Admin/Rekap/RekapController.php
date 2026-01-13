<?php

namespace App\Http\Controllers\Admin\Rekap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RekapNilai;
use App\Models\Kelas;
use App\Models\Semester;
use App\Exports\RekapExport;
use App\Models\Diskusi;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;

class RekapController extends Controller
{
    /**
     * TAMPIL HALAMAN REKAP
     */
    public function index(Request $request)
    {
        $kelasId    = $request->kelas_id;
        $semesterId = $request->semester_id;
        $nilaiHuruf = $request->nilai;

        $kelas    = Kelas::all();
        $semester = Semester::all();

        $rekap = RekapNilai::with(['kelas', 'semester'])
            ->when($kelasId, function ($q) use ($kelasId) {
                $q->where('id_kelas', $kelasId);
            })
            ->when($semesterId, function ($q) use ($semesterId) {
                $q->where('id_semester', $semesterId);
            })
            ->get();

        // dd($rekap);

        if ($nilaiHuruf && $nilaiHuruf !== 'semua') {
            $rekap = $rekap->filter(function ($item) use ($nilaiHuruf) {
                return optional($item->grade)->huruf === $nilaiHuruf;
            })->values(); // reset index agar blade rapi
        }

        return view('admin.rekap.index', compact(
            'rekap',
            'kelas',
            'semester'
        ));
    }

    /**
     * GENERATE / UPDATE DATA REKAP NILAI
     */
    public function generateRekap()
    {
        /**
         * Ambil user + data diri
         */
        $users = User::select('id', 'nim')
            ->with([
                'datadiri:id,user_id,nama_lengkap,id_kelas,id_semester'
            ])
            ->whereHas('datadiri')
            ->get();

        foreach ($users as $user) {

            $dataDiri = $user->datadiri;
            if (!$dataDiri) continue;

            /**
             * ======================
             * NILAI KARYA (40%)
             * ======================
             */
            $nilaiKarya = DB::table('data_karyas')
                ->where('user_id', $user->id)
                ->avg('total_nilai') ?? 0;

            /**
             * ======================
             * NILAI UJIAN (40%)
             * ======================
             */
            $nilaiUjian = DB::table('data_ujians')
                ->where('user_id', $user->id)
                ->avg('score') ?? 0;

            /**
             * ======================
             * NILAI DISKUSI (20%)
             * HITUNG PER FORUM
             * ======================
             */
            $diskusiPerForum = Diskusi::select(
                'kdforum',
                DB::raw('COUNT(*) as jumlah_pesan')
            )
                ->where('user_id', $user->id)
                ->groupBy('kdforum')
                ->get();

            $nilaiForum = [];

            foreach ($diskusiPerForum as $forum) {
                if ($forum->jumlah_pesan >= 20) {
                    $nilaiForum[] = 100;
                } elseif ($forum->jumlah_pesan >= 15) {
                    $nilaiForum[] = 90;
                } elseif ($forum->jumlah_pesan >= 10) {
                    $nilaiForum[] = 80;
                } elseif ($forum->jumlah_pesan >= 5) {
                    $nilaiForum[] = 75;
                } else {
                    $nilaiForum[] = 70;
                }
            }

            // Rata-rata nilai diskusi (jika tidak ada forum → 70 default)
            $nilaiDiskusi = count($nilaiForum)
                ? array_sum($nilaiForum) / count($nilaiForum)
                : 70;

            /**
             * ======================
             * NILAI AKHIR (BERBOBOT)
             * ======================
             */
            $nilaiAkhir =
                ($nilaiKarya * 0.4) +
                ($nilaiUjian * 0.4) +
                ($nilaiDiskusi * 0.2);

            /**
             * ======================
             * SIMPAN KE REKAP
             * ======================
             */
            RekapNilai::updateOrCreate(
                ['nim' => $user->nim],
                [
                    'nama_lengkap'  => $dataDiri->nama_lengkap,
                    'id_kelas'      => $dataDiri->id_kelas,
                    'id_semester'   => $dataDiri->id_semester,
                    'rekap_karya'   => round($nilaiKarya, 2),
                    'rekap_ujian'   => round($nilaiUjian, 2),
                    'rekap_diskusi' => round($nilaiDiskusi, 2),
                    'nilai_akhir'   => round($nilaiAkhir, 2),
                ]
            );
        }

        return redirect()
            ->route('admin.rekap.index')
            ->with('success', 'Rekap nilai berhasil diperbarui');
    }

    /**
     * EXPORT EXCEL
     */
    public function export(Request $request)
    {
        return Excel::download(
            new RekapExport($request),
            'Rekap_Nilai_Mahasiswa.xlsx'
        );
    }

    /**
     * HAPUS DATA REKAP
     */
    public function destroy($id)
    {
        RekapNilai::findOrFail($id)->delete();

        return redirect()->back()
            ->with('success', 'Data rekap berhasil dihapus');
    }
}
