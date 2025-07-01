<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = $request->input('identifier');
        $password = $request->input('password');

        // Cari pengguna berdasarkan NIM atau username
        $user = User::where('nim', $identifier)
            ->orWhere('username', $identifier)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'identifier' => ['NIM atau Username belum terdaftar. Silakan registrasi terlebih dahulu!'],
            ]);
        }

        // Tentukan kolom autentikasi berdasarkan peran
        $loginField = $user->role === 'mahasiswa' ? 'nim' : 'username';
        $credentials = [
            $loginField => $identifier,
            'password' => $password,
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();
            $role = Auth::user()->role;

            // Redirect berdasarkan peran
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'dosen':
                    return redirect()->route('dosen.dashboard');
                case 'mahasiswa':
                    return redirect()->route('mahasiswa.dashboard');
                default:
                    return redirect('/'); // Fallback
            }
        } else {
            throw ValidationException::withMessages([
                'identifier' => ['NIM/Username atau password salah. Silakan coba lagi!'],
            ]);
        }
    }

    public function logout()
    {
        Auth::logout();

        // Tambahkan logika lain jika diperlukan, seperti menghapus sesi atau membersihkan cache.

        return redirect('/'); // Ganti dengan URL yang sesuai setelah logout.
    }
}
