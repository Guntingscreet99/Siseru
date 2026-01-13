<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DataForum;
use App\Models\RekapForum;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;  // ← Tambahkan ini

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Tambahkan baris ini untuk mengubah pagination ke Bootstrap 5
        Paginator::useBootstrapFive();

        // Cek setiap request: kalau ada forum yang sudah lewat & belum direkap → buat rekap
        // DataForum::whereNotNull('waktu_selesai')
        //     ->where('waktu_selesai', '<', now())
        //     ->where('sudah_direkap', false)
        //     ->with('diskusis.user')
        //     ->chunk(10, function ($forums) {
        //         foreach ($forums as $forum) {
        //             $pesan = $forum->diskusis()
        //                 ->orderBy('created_at')
        //                 ->get()
        //                 ->map(function ($d) {
        //                     return "{$d->created_at->format('d/m/Y H:i')} - {$d->user->name}: {$d->pesan}";
        //                 })->implode("\n");

        //             $rekap = "REKAP DISKUSI FORUM\n";
        //             $rekap .= "Topik     : {$forum->topik}\n";
        //             $rekap .= "Kelas     : {$forum->kelas->nama_kelas}\n";
        //             $rekap .= "Semester  : {$forum->semester->nama_semester}\n";
        //             $rekap .= "Durasi    : {$forum->durasi_menit} menit\n";
        //             $rekap .= "Berakhir  : {$forum->waktu_selesai->format('d/m/Y H:i')}\n";
        //             $rekap .= str_repeat("=", 50) . "\n\n";
        //             $rekap .= $pesan ?: "Tidak ada pesan.";

        //             RekapForum::create([
        //                 'kdforum' => $forum->kdforum,
        //                 'isi_rekap' => $rekap,
        //                 'dibuat_oleh' => auth()->id() ?? null,
        //             ]);

        //             $forum->update(['sudah_direkap' => true]);
        //         }
        //     });
    }
}
