<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataModul extends Model
{
    protected $guarded = [];
    protected $table = 'data_moduls';
    protected $primaryKey = 'kdmodul';
    public $incrementing = false;
}
