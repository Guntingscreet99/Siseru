<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ujian extends Model
{
    protected $table = 'ujians';
    protected $primaryKey = 'kduji';
    public $incrementing = true;
    protected $keyType =  'int';

    protected $fillable = [
        'kduji',
        'ujian',
        'id_kelas',
        'id_semester',
        'link',
        'judulFileAsli',
        'waktu_mulai',
        'durasi_menit',
        'waktu_selesai',
        'status',
    ];

    protected $casts = [
        'waktu_mulai' => 'datetime',
        // 'waktu_selesai' => 'datetime',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester');
    }

    public function hasilUjian()
    {
        return $this->hasMany(DataUjian::class);
    }

    public function isAktif(): bool
    {
        if (!$this->waktu_mulai || !$this->durasi_menit) {
            return false;
        }

        $waktuSelesai = Carbon::parse($this->waktu_mulai)
            ->addMinutes($this->durasi_menit);

        return now()->between($this->waktu_mulai, $waktuSelesai);
    }

    public function waktuSelesai()
    {
        if (!$this->waktu_mulai || !$this->durasi_menit) {
            return null;
        }

        return Carbon::parse($this->waktu_mulai)
            ->addMinutes($this->durasi_menit);
    }
}
