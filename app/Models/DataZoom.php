<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataZoom extends Model
{
    protected $guarded = [];
    // protected $table = 'data_zooms';
    // protected $primaryKey = 'kdzoom';
    // public $incrementing = false;

    protected $table = 'data_zooms'; // Pastikan tabel sesuai dengan database

    protected $primaryKey = 'kdzoom'; // Jika primary key bukan 'id', harus didefinisikan

    protected $fillable = ['kelas', 'link']; // Pastikan atribut ini bisa diisi

    public $timestamps = false; // Jika tidak ada `created_at` dan `updated_at`
}
