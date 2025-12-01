<?php

namespace App\Http\Controllers\User\Menu\DataDiri;

use App\Http\Controllers\Controller;
use App\Models\DataDiri;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Profil\Identitas;
use App\Models\Semester; // Perbaikan dari Moodels ke Models
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class DatadiriController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:mahasiswa');
    }

    public function create()
    {
        $user = User::where('id', Auth::user()->id)
            ->with('datadiri.kelas', 'datadiri.semester')->first();

        $kelas = Kelas::all();
        $semester = Semester::all();

        // dd($user);

        return view('user.menu.data_diri.index', compact('kelas', 'semester', 'user'));
    }

    public function simpan(Request $request)
    {
        $userId = Auth::id();

        // Ambil user + relasi datadiri untuk validasi kondisional
        $user = User::with('datadiri')->findOrFail($userId);

        // Validasi
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nim'          => 'required|string|max:20|unique:users,nim,' . $userId,
            'email'        => 'required|email|max:255',
            'no_hp'        => 'nullable|string|max:15',
            'tempat'       => 'nullable|string|max:100',
            'tgllahir'     => 'nullable|date',
            'alamat'       => 'required|string',

            // Wajib hanya saat pertama kali isi (setelah itu tetap bisa diubah)
            'jenisKelamin' => ($user->datadiri && $user->datadiri->jenisKelamin) ? 'required|in:Laki-laki,Perempuan' : 'required|in:Laki-laki,Perempuan',
            'id_kelas'     => ($user->datadiri && $user->datadiri->id_kelas)     ? 'required|exists:kelas,id'       : 'required|exists:kelas,id',
            'id_semester'  => ($user->datadiri && $user->datadiri->id_semester)  ? 'required|exists:semesters,id'   : 'required|exists:semesters,id',

            'fotoMhs'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // 2MB
        ], [
            'nama_lengkap.required' => 'Nama Lengkap wajib diisi!',
            'nim.required'           => 'NIM wajib diisi!',
            'nim.unique'             => 'NIM sudah digunakan oleh mahasiswa lain!',
            'email.required'         => 'Email wajib diisi!',
            'alamat.required'        => 'Alamat wajib diisi!',
            'jenisKelamin.required'  => 'Jenis Kelamin wajib dipilih!',
            'id_kelas.required'      => 'Kelas wajib dipilih!',
            'id_semester.required'   => 'Semester wajib dipilih!',
            'fotoMhs.image'          => 'File harus berupa gambar!',
            'fotoMhs.max'            => 'Ukuran foto maksimal 2MB!',
        ]);

        // ========================================
        // 1. Update tabel users (NIM, email, nama, dll)
        // ========================================
        User::where('id', $userId)->update([
            'nim'          => $request->nim,
            'nama_lengkap' => $request->nama_lengkap,
            'email'        => $request->email,
            'no_hp'        => $request->no_hp,
            // 'username'  => $request->username ?? null, // kalau ada field username
        ]);

        // ========================================
        // 2. Upload foto (jika ada)
        // ========================================
        $fotoMhsPath   = null;
        $judulFileAsli = null;

        if ($request->hasFile('fotoMhs')) {
            $file          = $request->file('fotoMhs');
            $judulFileAsli = $file->getClientOriginalName();
            $fotoMhsPath   = $file->store('fotoMhs', 'public');
        }

        // ========================================
        // 3. Simpan / Update tabel data_diris
        //    (TANPA kolom nim → karena nim sudah di tabel users)
        // ========================================
        $dataDiriPayload = [
            'user_id'      => $userId,
            'nama_lengkap' => $request->nama_lengkap,
            'id_kelas'     => $request->id_kelas,
            'id_semester'  => $request->id_semester,
            'alamat'       => $request->alamat,
            'tempat'       => $request->tempat,
            'tgllahir'     => $request->tgllahir,
            'jenisKelamin' => $request->jenisKelamin,
            'fotoMhs'      => $fotoMhsPath,
            'judulFileAsli' => $judulFileAsli,
            'status'       => $request->status ?? null,
        ];

        $dataDiri = DataDiri::where('user_id', $userId)->first();

        if ($dataDiri) {
            $dataDiri->update($dataDiriPayload);
            $message = 'Data diri berhasil diperbarui!';
        } else {
            DataDiri::create($dataDiriPayload);
            $message = 'Data diri berhasil disimpan!';
        }

        return redirect()
            ->route('mahasiswa.data-diri')
            ->with('success', $message);
    }

    // public function edit(Request $reqeust, $id) {

    // }
}
