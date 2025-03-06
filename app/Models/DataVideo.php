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

    protected $fillable = ['judul', 'deskripsi', 'link', 'fileVideo']; // Pastikan field ini ada di DB



}


