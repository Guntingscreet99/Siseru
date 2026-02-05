<?php

namespace App\Http\Controllers\User\Menu\Ujian;

use App\Http\Controllers\Controller;
use App\Models\Ujian;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UjianController extends Controller
{
    public function index()
    {
        $ujians = Ujian::with('kelas', 'semester')
            ->where('status', 'Ditampilkan')
            ->orderBy('waktu_mulai', 'asc')
            ->get()
            ->map(function ($item) {

                // Format waktu mulai (AMAN UNTUK BLADE)
                $item->waktu_mulai_format = $item->waktu_mulai
                    ? Carbon::parse($item->waktu_mulai)
                    ->translatedFormat('d F Y, H:i')
                    : '-';

                // Hitung waktu selesai
                if ($item->waktu_mulai && $item->durasi_menit) {
                    $item->waktu_selesai = Carbon::parse($item->waktu_mulai)
                        ->addMinutes($item->durasi_menit);
                } else {
                    $item->waktu_selesai = null;
                }

                return $item;
            });

        return view('user.menu.ujian.index', compact('ujians'));
    }

    public function cariData(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->input('query');

            $ujians = Ujian::with('kelas', 'semester')
                ->where('status', 'Ditampilkan')
                ->where(function ($q) use ($query) {
                    $q->where('ujian', 'like', "%{$query}%")
                        ->orWhereHas('kelas', function ($k) use ($query) {
                            $k->where('nama_kelas', 'like', "%{$query}%");
                        })
                        ->orWhereHas('semester', function ($s) use ($query) {
                            $s->where('nama_semester', 'like', "%{$query}%");
                        });
                })
                ->orderBy('waktu_mulai', 'asc')
                ->get()
                ->map(function ($item) {

                    $item->waktu_mulai_format = $item->waktu_mulai
                        ? Carbon::parse($item->waktu_mulai)
                        ->translatedFormat('d F Y, H:i')
                        : '-';

                    if ($item->waktu_mulai && $item->durasi_menit) {
                        $item->waktu_selesai = Carbon::parse($item->waktu_mulai)
                            ->addMinutes($item->durasi_menit);
                    } else {
                        $item->waktu_selesai = null;
                    }

                    return $item;
                });

            return response()->json($ujians);
        }

        return redirect()->route('user.ujian.index');
    }
}
