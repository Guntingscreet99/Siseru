<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeringkat extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'data_peringkats';
    protected $primaryKey = 'kdperingkat';
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
