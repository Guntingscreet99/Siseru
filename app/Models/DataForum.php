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

    protected $fillable = ['akun', 'kelas', 'semester', 'topik', 'tahun', 'fileForum'];
}
