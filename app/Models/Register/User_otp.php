<?php

namespace App\Models\Register;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class User_otp extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
