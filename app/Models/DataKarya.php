<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DataKarya extends Model
{
    use HasFactory;

    protected $table = 'data_Karyas';
    protected $primaryKey = 'kdkarya';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'namaMhs',
        'nim',
        'namaKarya',
        'id_kelas',
        'id_semester',
        'deskripsi',
        'fileKarya',
        'judulFileAsli',
    ];

    // Relasi ke User (penting banget buat cek "karya saya")
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }

    // Optional: accessor biar lebih gampang ambil URL file
    public function getFileUrlAttribute()
    {
        return $this->fileKarya ? Storage::url($this->fileKarya) : null;
    }
}
