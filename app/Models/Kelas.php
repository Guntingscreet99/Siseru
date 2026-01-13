<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = [];

    public function modul()
    {
        return $this->hasMany(DataModul::class, 'id_kelas', 'id');
    }

    public function karya()
    {
        return $this->hasMany(DataKarya::class, 'id_kelas', 'id');
    }

    public function forum()
    {
        return $this->hasMany(DataForum::class, 'id_kelas', 'id');
    }

    public function zoom()
    {
        return $this->hasMany(DataZoom::class, 'id_kelas', 'id');
    }

    public function datadiri()
    {
        return $this->hasMany(DataDiri::class, 'id_kelas', 'id');
    }

    public function peringkat()
    {
        return $this->hasMany(DataPeringkat::class, 'id_kelas', 'id');
    }

    public function ujian()
    {
        return $this->hasMany(Ujian::class, 'id_kelas', 'id');
    }

    
}
