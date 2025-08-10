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
        $user = User::where('id', Auth::user()->id)->first();

        $kelas = Kelas::all();
        $semester = Semester::all();

        // dd($user);

        return view('user.menu.data_diri.index', compact('kelas', 'semester', 'user'));
    }

    // public function index()
    // {
    //     $user = Auth::id();

    //     $dataDiri = Identitas::with('user')->where('user_id', $user)->first();

    //     // dd($dataDiri);

    //     $kelas = Kelas::all();
    //     $semester = Semester::all();

    //     return view('user.menu.data_diri.index', compact('kelas', 'semester', 'user', 'dataDiri'));
    // }

    public function simpan(Request $request)
    {
        // dd($request->all());

        $request->validate(
            [
                'nama_lengkap' => 'required|string',
                'id_kelas' => 'required|exists:kelas,id',
                'id_semester' => 'required|exists:semesters,id',
                'fotoMhs' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mkv,avi|max:51200',
                'alamat' => 'required|string',
                'jenisKelamin' => 'required|string',
            ],
            [
                'nama_lengkap.required' => 'Nama Lengkap Wajib Diisi!',
                'id_kelas.required' => 'Kelas Wajib Diisi!',
                'id_kelas.exists' => 'Kelas yang dipilih tidak valid!',
                'id_semester.required' => 'Semester Wajib Diisi!',
                'id_semester.exists' => 'Semester yang dipilih tidak valid!',
                'fotoMhs.mimes' => 'Format file harus jpg, jpeg, png, mp4, mkv, atau avi!',
                'fotoMhs.max' => 'Ukuran file maksimal 50MB!',
                'alamat.required' => 'Alamat Wajib Diisi!',
                'jenisKelamin.required' => 'Jenis Kelamin Wajib Diisi!',
            ]
        );

        $userId = Auth::id(); // Ambil ID pengguna yang sedang login
        $fotoMhsPath = null;
        $judulFileAsli = null;

        // Proses unggahan file jika ada
        if ($request->hasFile('fotoMhs')) {
            $file = $request->file('fotoMhs');
            $judulFileAsli = $file->getClientOriginalName();
            $fotoMhsPath = $file->store('fotoMhs', 'public');
        }

        // Cek apakah data diri sudah ada untuk pengguna ini
        $dataDiri = DataDiri::where('user_id', $userId)->first();

        $data = [
            'user_id' => $userId,
            'nama_lengkap' => $request->input('nama_lengkap'),
            'id_kelas' => $request->input('id_kelas'),
            'id_semester' => $request->input('id_semester'),
            'alamat' => $request->input('alamat'),
            'tempat' => $request->input('tempat'),
            'tgllahir' => $request->input('tgllahir'),
            'jenisKelamin' => $request->input('jenisKelamin'),
            'fotoMhs' => $fotoMhsPath ?? null, // Gunakan null jika tidak ada file
            'judulFileAsli' => $judulFileAsli ?? null,
            'status' => $request->input('status'),
        ];

        if ($dataDiri) {
            $dataDiri->update($data);
            $message = 'Data Berhasil Diperbarui';
        } else {
            DataDiri::create($data);
            $message = 'Data Berhasil Disimpan';
        }

        return redirect()->route('mahasiswa.data-diri')->with('success', $message);
    }
}
