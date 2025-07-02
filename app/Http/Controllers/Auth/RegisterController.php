<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Register\User_otp;
use App\Models\Semester;
use App\Models\User;
use App\Services\TwilioService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    protected $twilioService;

    public function __construct(TwilioService $twilioService)
    {
        $this->middleware('guest');
        $this->twilioService = $twilioService;
    }

    private function formatPhoneNumber($no_hp)
    {
        // Hilangkan spasi dan karakter non-digit
        $no_hp = preg_replace('/\D/', '', $no_hp);

        // Jika nomor diawali dengan "08", ubah menjadi "+62"
        if (substr($no_hp, 0, 2) === "08") {
            $no_hp = "+62" . substr($no_hp, 1);
        } elseif (substr($no_hp, 0, 3) !== "+62") {
            // Jika tidak dimulai dengan 08 atau +62, tambahkan +62
            $no_hp = "+62" . $no_hp;
        }

        return $no_hp;
    }

    public function register()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        Log::info('Mulai proses pendaftaran');

        try {
            // Validasi input
            $request->validate([
                'nama_lengkap' => ['required', 'string', 'max:255'],
                'nim' => ['nullable', 'string', 'max:20', 'unique:users,nim'],
                // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
                'no_hp' => ['required', 'string', 'unique:users,no_hp', 'regex:/^[0-9]+$/'],
                'password' => ['required', 'string', 'min:3'],
                // 'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            ]);

            Log::info('Validasi berhasil', ['data' => $request->all()]);

            // Format nomor HP
            $no_hp = $this->formatPhoneNumber($request->no_hp);
            Log::info('Nomor HP setelah diformat: ' . $no_hp);

            // Cek apakah nomor HP sudah ada
            if (User::where('no_hp', $no_hp)->exists()) {
                Log::warning('Nomor sudah terdaftar', ['no_hp' => $no_hp]);
                return redirect()->back()->with('error', 'Nomor sudah terdaftar.');
            }

            // Tentukan role berdasarkan NIM
            $role = $request->filled('nim') ? 'mahasiswa' : 'dosen';
            Log::info('Role yang ditentukan: ' . $role);

            // Simpan password asli sebelum di-hash
            $plainPassword = $request->password;

            // Buat OTP
            $otp = rand(100000, 999999);
            Log::info('OTP yang dibuat: ' . $otp);

            // Kirim OTP ke WhatsApp
            $otpMessage = "Kode OTP Anda: $otp. Berlaku selama 5 menit.";
            $otpSent = $this->twilioService->sendWhatsAppMessage($no_hp, $otpMessage);

            if ($otpSent) {
                Log::info('Membuat user baru');

                // Gunakan transaksi untuk menyimpan data
                DB::beginTransaction();
                try {
                    // Simpan user ke tabel users
                    $user = new User();
                    $user->username = $request->username;
                    $user->nama_lengkap = $request->nama_lengkap;
                    $user->nim = $request->nim;
                    $user->email = $request->email;
                    $user->no_hp = $no_hp;
                    $user->password = Hash::make($plainPassword);
                    $user->role = $role;
                    $user->status = 'A';
                    $user->save();

                    // Simpan OTP ke tabel user_otp
                    $userOtp = new User_otp();
                    $userOtp->user_id = $user->id;
                    $userOtp->otp = $otp;
                    $userOtp->otp_expiry = Carbon::now()->addMinutes(5);
                    $userOtp->is_verified = false;
                    $userOtp->save();

                    Log::info('User dan OTP berhasil dibuat', ['user' => $user, 'otp' => $userOtp]);

                    // Kirim pesan konfirmasi pendaftaran
                    $welcomeMessage = "Halo *{$user->nama_lengkap}*,\n\n" .
                        "Terimakasih. Akun Anda telah berhasil terdaftar.\n\n" .
                        "*Nama Lengkap  :* " . ($user->nama_lengkap) . "\n" .
                        // "*Role:* {$user->role}\n" .
                        "*NIM           :* " . ($user->nim ?? 'Tidak ada') . "\n" .
                        "*Password      :* " . ($plainPassword) . "\n" .
                        "Gunakan Nim dan Password Anda untuk login.\n\n" .
                        "Terimakasih! 🙌";

                    $this->twilioService->sendWhatsAppMessage($no_hp, $welcomeMessage);

                    DB::commit();
                    return redirect()->route('verify.otp', ['user_id' => $user->id])
                        ->with('success', 'Kode OTP telah dikirim.');
                } catch (\Exception $e) {
                    DB::rollBack();
                    Log::error('Gagal menyimpan user atau OTP: ' . $e->getMessage());
                    return redirect()->back()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
                }
            } else {
                Log::error('Gagal mengirim kode OTP');
                return redirect()->back()->with('error', 'Gagal mengirim kode OTP.');
            }
        } catch (\Exception $e) {
            Log::error('Error saat pendaftaran: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan. Silakan coba lagi.');
        }
    }

    protected function registered(Request $request, $user)
    {
        // Logout dulu agar tidak langsung masuk ke dashboard
        Auth::logout();

        // Redirect ke halaman verifikasi OTP
        return redirect()->route('verify.otp', ['user_id' => $user->id])->with('success', 'Kode OTP telah dikirim.');
    }

    public function showOtpForm($user_id)
    {
        Log::info('Masuk ke halaman verifikasi OTP', ['user_id' => $user_id]);

        $user = User::find($user_id);

        if (!$user) {
            Log::warning('User tidak ditemukan', ['user_id' => $user_id]);
            return redirect()->route('register')->with('error', 'User tidak ditemukan.');
        }

        return view('auth.verify-otp', [
            'user_id' => $user_id,
            'user' => $user,
        ]);
    }

    public function verifyOtp(Request $request)
    {
        Log::info('Mulai proses verifikasi OTP', ['request' => $request->all()]);

        try {
            // Validasi input
            $request->validate([
                'user_id' => ['required', 'exists:users,id'],
                'otp' => ['required', 'string', 'size:6', 'regex:/^[0-9]+$/'],
            ]);

            // Ambil data OTP dari tabel user_otp
            $userOtp = User_otp::where('user_id', $request->user_id)
                ->where('otp', $request->otp)
                ->where('otp_expiry', '>=', Carbon::now())
                ->first();

            if (!$userOtp) {
                Log::warning('Kode OTP salah atau kedaluwarsa', ['user_id' => $request->user_id, 'otp' => $request->otp]);
                return back()->with('error', 'Kode OTP salah atau sudah kedaluwarsa.');
            }

            // Update status verifikasi di tabel user_otp
            $userOtp->update([
                'is_verified' => true,
                'otp' => null,
                'otp_expiry' => null,
            ]);

            Log::info('Verifikasi OTP berhasil', ['user_id' => $request->user_id]);

            return redirect()->route('login')->with('success', 'Verifikasi berhasil! Silakan login.');
        } catch (\Exception $e) {
            Log::error('Error saat verifikasi OTP: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat verifikasi. Silakan coba lagi.');
        }
    }

    public function resendOtp(Request $request)
    {
        $request->validate([
            'user_id' => 'required', // Pastikan user_id dikirim
        ]);

        // Cari user berdasarkan ID
        $user = User::find($request->user_id);

        if (!$user) {
            return back()->with('error', 'User tidak ditemukan.');
        }

        // Generate OTP baru
        $otp = rand(100000, 999999);
        $user->update([
            'otp' => $otp,
            'otp_expiry' => Carbon::now()->addMinutes(5),
        ]);

        // Kirim ulang OTP ke WhatsApp
        $this->twilioService->sendWhatsAppMessage($user->no_hp, "Kode verifikasi baru Anda adalah: $otp");

        return redirect()->route('verify.otp', ['user_id' => $user->id])->with('success', 'Kode OTP telah dikirim ulang.');
    }

    protected function redirectToRolePage($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard'); // Ganti sesuai route customer
            case 'dosen':
                return redirect()->route('dosen.dashboard'); // Ganti sesuai route sopir
            case 'mahasiswa':
                return redirect()->route('mahasiswa.dashboard'); // Ganti sesuai route admin
            default:
                return redirect()->route('login')->withErrors(['access' => 'Role tidak dikenali']);
        }
    }
}
