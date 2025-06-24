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

    protected $fillable =['judul','kelas','semester','topik','tahun','fileModul', 'judulFileAsli', 'status'];
}
