<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataForum extends Model
{
    protected $guarded = [];
    protected $table = 'data_forums';
    protected $primaryKey = 'kdforum';
    public $incrementing = true;
    protected $keyType = 'int';

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas', 'id');
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class, 'id_semester', 'id');
    }
}
