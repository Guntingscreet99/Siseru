<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Semester;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register()
    {
        $kelas = Kelas::all();
        $semester = Semester::all();

        return view('auth.register', compact('kelas', 'semester'));
    }
}
