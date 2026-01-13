<?php

namespace App\Models;

use Illuminate\Database\Eloquent\factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPerpustakaan extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'data_perpustakaans';
    protected $primaryKey = 'kdperpus';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori',
        'topik',
        'tahun',
        'status',
        'filePerpus',
        'judulFileAsli',
        'cover',
        'user_id',
    ];

    // protected $fillable = ['judul', 'deskripsi', 'kategori', 'topik', 'tahun', 'filePerpus', 'status'];
}
