<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataUjian extends Model
{
    protected $guarded = [];
    protected $table = 'data_ujians';
    protected $primaryKey = 'kdujian';
    public $incrementing = true;
    protected $keyType =  'int';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function hasilUjian()
    {
        return $this->belongsTo(Ujian::class);
    }
}
