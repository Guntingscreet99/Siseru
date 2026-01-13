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
        $ujians = Ujian::where('status', 'Ditampilkan')
            ->orderBy('waktu_mulai', 'asc')
            ->get()
            ->map(function ($item) {

                // Format waktu mulai untuk blade
                $item->waktu_mulai_format = $item->waktu_mulai
                    ? Carbon::parse($item->waktu_mulai)
                    ->translatedFormat('d F Y, H:i')
                    : '-';

                // Hitung waktu selesai dari durasi
                if ($item->waktu_mulai && $item->durasi_menit) {
                    $item->waktu_selesai = Carbon::parse($item->waktu_mulai)
                        ->addMinutes($item->durasi_menit);
                }

                return $item;
            });

        return view('user.menu.zoom.index', compact('ujians'));
    }

    public function cariData(Request $request)
    {
        if ($request->ajax()) {

            $query = $request->input('query');

            $ujians = Ujian::where('status', 'Ditampilkan')
                ->where(function ($q) use ($query) {
                    $q->where('ujian', 'like', "%{$query}%")
                        ->orWhere('kelas', 'like', "%{$query}%")
                        ->orWhere('semester', 'like', "%{$query}%");
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
                    }

                    return $item;
                });

            return response()->json($ujians);
        }

        return redirect()->route('user.ujian.index');
    }
}
