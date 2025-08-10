<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    protected $guarded = [];

    public function modul()
    {
        return $this->hasMany(DataModul::class, 'id_semester', 'id');
    }

    public function karya()
    {
        return $this->hasMany(DataKarya::class, 'id_semester', 'id');
    }

    public function forum()
    {
        return $this->hasMany(DataForum::class, 'id_semester', 'id');
    }
}
