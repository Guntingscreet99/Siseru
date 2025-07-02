<?php

namespace App\Models\Profil;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Identitas extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
