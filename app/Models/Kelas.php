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
}
