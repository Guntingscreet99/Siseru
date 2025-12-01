<?php

namespace App\Http\Controllers\User\Menu\Forum;

use App\Http\Controllers\Controller;
use App\Models\DataForum;
use App\Models\Diskusi;
use App\Models\RekapForum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiskusiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        $dataDiri = $user->datadiri;

        $forum = DataForum::with('kelas', 'semester')
            ->where('id_kelas', $dataDiri->id_kelas)
            ->where('id_semester', $dataDiri->id_semester)
            ->get();

        return view('user.menu.diskusi.index', compact('forum'));
    }

    public function pesan($kdforum)
    {
        $pesans = Diskusi::where('kdforum', $kdforum)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        $output = '';
        if ($pesans->count() == 0) {
            $output .= '<div class="text-center text-muted">Belum ada pesan. Jadilah yang pertama!</div>';
        }

        foreach ($pesans as $p) {
            $waktu = $p->created_at->format('d-m-Y H:i');
            $nama  = $p->user->nama_lengkap ?? 'Mahasiswa';
            $align = Auth::id() == $p->user_id ? 'text-end' : 'text-start';
            $bg    = Auth::id() == $p->user_id ? 'bg-primary text-white' : 'bg-light border';

            $output .= <<<HTML
                <div class="mb-3 $align">
                    <div class="d-inline-block p-3 rounded $bg" style="max-width:85%;">
                        <strong class="d-block mb-1">$nama</strong>
                        <div class="mb-1">{$p->pesan}</div>
                        <small class="text-muted opacity-75">$waktu</small>
                    </div>
                </div>
            HTML;
        }

        return $output;
    }

    // === FITUR BARU: KIRIM PESAN + CEK WAKTU + REKAP OTOMATIS ===
    public function kirim(Request $request)
    {
        $request->validate([
            'kdforum' => 'required|exists:data_forums,kdforum',
            'pesan'   => 'required|string|max:1000'
        ]);

        // Ambil forum
        $forum = DataForum::where('kdforum', $request->kdforum)->firstOrFail();

        // CEK: Apakah diskusi sudah berakhir? (1 jam dari pembuatan)
        if ($forum->waktu_selesai && now()->greaterThan($forum->waktu_selesai)) {
            // Otomatis simpan rekap jika belum pernah
            if (!$forum->sudah_direkap) {
                $this->simpanRekapOtomatis($forum);
            }

            return response()->json([
                'message' => 'Diskusi telah ditutup otomatis (waktu 1 jam telah habis).'
            ], 403);
        }

        // Simpan pesan baru
        Diskusi::create([
            'kdforum' => $request->kdforum,
            'user_id' => Auth::id(),
            'pesan'   => strip_tags($request->pesan)
        ]);

        // Cek lagi setelah kirim (bisa jadi pesan terakhir sebelum waktu habis)
        if ($forum->waktu_selesai && now()->greaterThan($forum->waktu_selesai) && !$forum->sudah_direkap) {
            $this->simpanRekapOtomatis($forum);
        }

        return response()->json(['success' => true]);
    }

    // === FUNGSI REKAP OTOMATIS ===
    private function simpanRekapOtomatis(DataForum $forum)
    {
        $pesan = Diskusi::where('kdforum', $forum->kdforum)
            ->with('user')
            ->orderBy('created_at', 'asc')
            ->get();

        if ($pesan->isEmpty()) return;

        $rekapTeks = "=== REKAP DISKUSI FORUM (DITUTUP OTOMATIS) ===\n\n";
        $rekapTeks .= "Topik         : {$forum->topik}\n";
        $rekapTeks .= "Kelas         : {$forum->kelas->nama_kelas}\n";
        $rekapTeks .= "Semester      : {$forum->semester->nama_semester}\n";
        $rekapTeks .= "Waktu Mulai   : {$forum->created_at->format('d/m/Y H:i')}\n";
        $rekapTeks .= "Waktu Selesai : {$forum->waktu_selesai->format('d/m/Y H:i')}\n";
        $rekapTeks .= "Total Pesan   : {$pesan->count()} pesan\n";
        $rekapTeks .= "Direkap pada  : " . now()->format('d F Y H:i:s') . "\n";
        $rekapTeks .= str_repeat("=", 60) . "\n\n";

        foreach ($pesan as $p) {
            $waktu = $p->created_at->format('d/m H:i');
            $nama  = $p->user->nama_lengkap ?? 'Mahasiswa';
            $rekapTeks .= "[$waktu] $nama:\n";
            $rekapTeks .= $p->pesan . "\n\n";
        }

        $rekapTeks .= str_repeat("=", 60) . "\n";
        $rekapTeks .= "DISKUSI DITUTUP OTOMATIS OLEH SISTEM SETELAH 1 JAM\n";
        $rekapTeks .= "Tidak dapat mengirim pesan lagi.\n";

        // Simpan ke tabel rekap_forum
        // RekapForum::create([
        //     'kdforum'   => $forum->kdforum,
        //     'isi_rekap' => $rekapTeks,
        //     'user_id'   => null, // null = otomatis oleh sistem
        // ]);

        // Tandai forum sudah direkap
        $forum->update(['sudah_direkap' => true]);
    }
}
