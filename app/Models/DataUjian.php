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
}
