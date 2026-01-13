<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapNilai extends Model
{
    // Nama tabel di database (opsional, jaga-jaga kalau Laravel bingung)
    protected $table = 'rekap_nilais';

    protected $fillable = [
        'nama_lengkap',
        'nim',
        'id_kelas',
        'id_semester',
        'rekap_karya',
        'rekap_ujian',
        'rekap_diskusi',
        'nilai_angka'
    ];

    /* =====================
     * RELASI
     * ===================== */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }

    /* =====================
     * ACCESSOR NILAI ANGKA
     * (FINAL SCORE)
     * ===================== */
    public function getNilaiAngkaAttribute($value)
    {
        // jika nilai_angka sudah disimpan di DB
        if (!is_null($value)) {
            return round($value, 2);
        }

        // fallback (jika suatu saat dihitung ulang)
        $karya   = $this->rekap_karya ?? 0;
        $ujian   = $this->rekap_ujian ?? 0;
        $diskusi = $this->rekap_diskusi ?? 0;

        return round(($karya + $ujian + $diskusi) / 3, 2);
    }

    /* =====================
     * ACCESSOR GRADE
     * ===================== */
    public function getGradeAttribute()
    {
        $n = $this->nilai_angka ?? 0;

        if ($n >= 85) return (object)[
            'huruf' => 'A',
            'bobot' => 4.0,
            'kategori' => 'Istimewa',
            'lulus' => true
        ];

        if ($n >= 75) return (object)[
            'huruf' => 'AB',
            'bobot' => 3.5,
            'kategori' => 'Sangat Baik',
            'lulus' => true
        ];

        if ($n >= 67) return (object)[
            'huruf' => 'B',
            'bobot' => 3.0,
            'kategori' => 'Baik',
            'lulus' => true
        ];

        if ($n >= 61) return (object)[
            'huruf' => 'BC',
            'bobot' => 2.5,
            'kategori' => 'Cukup Baik',
            'lulus' => true
        ];

        if ($n >= 55) return (object)[
            'huruf' => 'C',
            'bobot' => 2.0,
            'kategori' => 'Cukup',
            'lulus' => true
        ];

        if ($n >= 45) return (object)[
            'huruf' => 'CD',
            'bobot' => 1.5,
            'kategori' => 'Kurang Cukup',
            'lulus' => false
        ];

        if ($n >= 35) return (object)[
            'huruf' => 'D',
            'bobot' => 1.0,
            'kategori' => 'Kurang',
            'lulus' => false
        ];

        if ($n >= 20) return (object)[
            'huruf' => 'DE',
            'bobot' => 0.5,
            'kategori' => 'Sangat Kurang',
            'lulus' => false
        ];

        return (object)[
            'huruf' => 'E',
            'bobot' => 0.0,
            'kategori' => 'Gagal',
            'lulus' => false
        ];
    }
}
