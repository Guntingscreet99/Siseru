<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataVideo extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'data_videos'; // Sesuaikan dengan nama tabel di database
    protected $primaryKey = 'kdvideo';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'judul',
        'deskripsi',
        'link',
        'fileVideo',
        'judulFileAsli',
        'user_id',
    ];

    // RELASI USER – INI YANG WAJIB ADA!!!
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // protected $fillable = ['judul', 'deskripsi', 'link', 'fileVideo', 'status']; // Pastikan field ini ada di DB



}
