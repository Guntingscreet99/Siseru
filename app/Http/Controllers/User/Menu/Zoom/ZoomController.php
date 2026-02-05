<?php

namespace App\Http\Controllers\User\Menu\Zoom;

use App\Http\Controllers\Controller;
use App\Models\DataZoom;
use Illuminate\Http\Request;

class ZoomController extends Controller
{
    /**
     * TAMPIL DATA ZOOM UNTUK USER
     * Hanya data yang Ditampilkan
     */
    public function index()
    {
        $zooms = \App\Models\DataZoom::with('kelas')
            ->where('status', 'Ditampilkan')
            ->get();

        return view('user.menu.zoom.index', compact('zooms'));
    }


    /**
     * SEARCH DATA ZOOM (AJAX)
     */
    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $query = $request->query('query');

            $zooms = DataZoom::with('kelas')
                ->where('status', 'Ditampilkan')
                ->whereHas('kelas', function ($q) use ($query) {
                    $q->where('nama_kelas', 'like', "%$query%");
                })
                ->orWhere('linkZoom', 'like', "%$query%")
                ->orWhere('linkWebinar', 'like', "%$query%")
                ->get();

            return response()->json($zooms);
        }

        abort(404);
    }
}
