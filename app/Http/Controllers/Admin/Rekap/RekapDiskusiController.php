<?php

namespace App\Http\Controllers\Admin\Rekap;

use App\Http\Controllers\Controller;
use App\Models\Diskusi;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

class RekapDiskusiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $kelasId = $request->input('kelas'); // Ganti nama variabel agar jelas
        $entries = $request->input('entries', 10);

        $query = Diskusi::select('user_id', 'kdforum', DB::raw('count(*) as jumlah_pesan'))
            ->with(['user.datadiri.kelas', 'user.datadiri.semester', 'forum'])
            ->groupBy('user_id', 'kdforum')
            ->orderBy('jumlah_pesan', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->whereHas('user', function ($q2) use ($search) {
                    $q2->where('username', 'like', '%' . $search . '%')
                        ->orWhere('nama_lengkap', 'like', '%' . $search . '%')
                        ->orWhere('nim', 'like', '%' . $search . '%');
                })->orWhereHas('forum', function ($q3) use ($search) {
                    $q3->where('topik', 'like', '%' . $search . '%');
                });
            });
        }

        if ($kelasId) {
            $query->whereHas('user.datadiri', function ($q) use ($kelasId) {
                $q->where('id_kelas', $kelasId);
            });
        }

        $rekap = $query->paginate($entries);

        // Top 3 user tercepat
        $topUsersQuery = Diskusi::select('user_id', DB::raw('count(*) as total_pesan'))
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('total_pesan', 'desc')
            ->take(3);

        if ($kelasId) {
            $topUsersQuery->whereHas('user.datadiri', function ($q) use ($kelasId) {
                $q->where('id_kelas', $kelasId);
            });
        }

        if ($search) {
            $topUsersQuery->whereHas('user', function ($q) use ($search) {
                $q->where('username', 'like', '%' . $search . '%')
                    ->orWhere('nama_lengkap', 'like', '%' . $search . '%')
                    ->orWhere('nim', 'like', '%' . $search . '%');
            });
        }

        $topUsers = $topUsersQuery->get();

        // Ambil data kelas dengan aman (selalu return collection)
        $kelas = Kelas::select('id', 'nama_kelas')->get();
        if (! $kelas instanceof Collection) {
            $kelas = collect([]); // Jadikan kosong jika error
        }

        return view('admin.Rekap.forum.index', compact('rekap', 'topUsers', 'search', 'kelas', 'entries'));
    }
}
