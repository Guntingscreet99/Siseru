<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DataKarya;
use App\Models\DataModul;
use App\Models\DataPerpustakaan;
use App\Models\DataVideo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDasboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $karyaSaya = DataKarya::where('user_id', $user->id)->count();
        $modulSaya = DataModul::where('user_id', $user->id)->count();
        $videoSaya = DataVideo::where('user_id', $user->id)->count();
        $materiSaya = DataPerpustakaan::where('user_id', $user->id)->count();

        return view('admin.dashboard', compact(
            'karyaSaya',
            'modulSaya',
            'videoSaya',
            'materiSaya'
        ));
    }
}
