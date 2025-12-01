<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RekapForum extends Model
{
    protected $table = 'rekap_forums';        // ini yang penting!

    protected $fillable = [
        'kdforum',
        'isi_rekap',
        'dibuat_oleh',
    ];

    protected $dates = ['dibuat_pada'];

    // Relasi ke DataForum
    public function forum()
    {
        return $this->belongsTo(DataForum::class, 'kdforum', 'kdforum');
    }

    // Relasi ke User (admin yang bikin rekap)
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}
