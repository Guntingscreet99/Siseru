<?php

namespace App\Http\Controllers\User\Menu\Testimoni;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    // Tampilkan semua testimoni
    public function index()
    {
        $testimonis = Testimoni::with('user.dataDiri')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.menu.testimoni.index', compact('testimonis'));
    }

    // Form tambah testimoni
    public function tampil()
    {
        $users = User::all();
        // untuk dropdown user
        return view('user.menu.testimoni.tambah', compact('users'));
    }

    // Simpan testimoni baru
    public function tambah(Request $request)
    {
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'pesan'  => 'required|string',
        ]);

        Testimoni::create([
            'user_id' => Auth::id(),
            'rating'  => $validated['rating'],
            'pesan'   => $validated['pesan'],
            'status'  => 0, // false
        ]);

        return redirect()
            ->route('user.testimoni.index')
            ->with('success', 'Testimoni berhasil ditambahkan.');
    }


    // Form edit testimoni
    public function edit(Testimoni $testimoni)
    {
        $users = User::all();
        return view('user.menu.testimoni.edit', compact('testimoni', 'users'));
    }

    // Update testimoni
    public function update(Request $request, Testimoni $testimoni)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'pesan' => 'required|string',
        ]);

        $testimoni->update($request->all());

        return redirect()->route('user.testimoni.index')->with('success', 'Testimoni berhasil diperbarui.');
    }

    // Hapus testimoni
    public function hapus(Testimoni $testimoni)
    {
        $testimoni->delete();
        return redirect()->route('user.testimoni.index')->with('success', 'Testimoni berhasil dihapus.');
    }
}
