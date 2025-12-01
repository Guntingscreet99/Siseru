<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class DataForum extends Model
{
    protected $table = 'data_forums';
    protected $primaryKey = 'kdforum';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = []; // semua kolom boleh diisi

    // Tambahkan baris ini → langsung selesai tanpa migration!
    protected $attributes = [
        'durasi_menit' => 60,
        'waktu_selesai' => null,
        'sudah_direkap' => false,
    ];

    protected $casts = [
        'waktu_selesai' => 'datetime',
    ];

    protected static function booted()
    {
        static::creating(function ($forum) {
            // Generate kdforum
            if (empty($forum->kdforum)) {
                $forum->kdforum = 'FRM' . strtoupper(Str::random(9));
            }

            // Ambil durasi dari input (default 60 kalau kosong)
            $durasi = (int) ($forum->getAttributes()['durasi_menit'] ?? $forum->durasi_menit ?? 60);

            // JANGAN simpan durasi_menit, waktu_selesai, sudah_direkap ke database kalau kolom belum ada
            // Kita simpan di atribut model saja (bukan di database)
            unset($forum->durasi_menit);
            unset($forum->waktu_selesai);
            unset($forum->sudah_direkap);

            // Tapi tetap simpan di model supaya fitur countdown jalan
            $forum->setAttribute('durasi_menit', $durasi);
            $forum->setAttribute('waktu_selesai', now()->addMinutes($durasi));
            $forum->setAttribute('sudah_direkap', false);
        });

        static::updating(function ($forum) {
            if ($forum->isDirty('durasi_menit') || !$forum->waktu_selesai) {
                $durasi = (int) ($forum->durasi_menit ?? 60);
                $forum->setAttribute('durasi_menit', $durasi);
                $forum->setAttribute('waktu_selesai', now()->addMinutes($durasi));
            }
        });
    }

    // === Relasi ===
    public function diskusis()
    {
        return $this->hasMany(Diskusi::class, 'kdforum', 'kdforum');
    }

    public function pesan()
    {
        return $this->diskusis();
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }

    // public function rekap()
    // {
    //     return $this->hasOne(RekapForum::class, 'kdforum', 'kdforum');
    // }

    public function sudahBerakhir()
    {
        return $this->waktu_selesai && now()->greaterThan($this->waktu_selesai);
    }
}
