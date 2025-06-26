<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataModul extends Model
{
    protected $guarded = [];
    protected $table = 'data_moduls';
    protected $primaryKey = 'kdmodul';
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
