<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DataZoom extends Model
{
    protected $guarded = [];
    protected $table = 'data_zooms';
    protected $primaryKey = 'kdzoom';
    public $incrementing = false;
}
