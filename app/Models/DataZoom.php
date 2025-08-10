<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataZoom extends Model
{
    protected $guarded = [];
    protected $table = 'data_zooms';
    protected $primaryKey = 'kdzoom';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }
}
