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

            /** @var \App\Models\User $user */
            $user = Auth::user();

            // ✅ UPDATE STATUS HANYA UNTUK MAHASISWA
            if ($user->role === 'mahasiswa') {
                $user->update([
                    'status' => 'B',
                    'last_seen_at' => now(),
                ]);
            }

            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');

                case 'dosen':
                    return redirect()->route('dosen.dashboard');

                case 'mahasiswa':
                    if (!$user->profile_completed) {
                        return redirect()
                            ->route('mahasiswa.data-diri')
                            ->with('info', 'Silakan lengkapi data diri Anda terlebih dahulu.');
                    }
                    return redirect()->route('mahasiswa.dashboard');

                default:
                    return redirect('/');
            }
        } else {
            throw ValidationException::withMessages([
                'identifier' => ['NIM/Username atau password salah. Silakan coba lagi!'],
            ]);
        }
    }

    public function logout(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        if ($user && $user->role === 'mahasiswa') {
            $user->update([
                'status' => 'A',
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
