<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataHasil extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'data_Karya';
    protected $primaryKey = 'kdkarya';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = ['nama', 'deskripsi', 'filekarya'];
}
