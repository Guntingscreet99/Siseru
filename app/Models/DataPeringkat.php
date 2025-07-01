<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPeringkat extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'data_peringkat';
    protected $primaryKey = 'kdperingkat';
    public $incrementing = true;
    protected $keyType = 'int';
}
