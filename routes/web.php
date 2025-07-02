<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Master\DataForumController;
use App\Http\Controllers\Admin\Master\DataHasilController;
use App\Http\Controllers\Admin\Master\DataKaryaController;
use App\Http\Controllers\Admin\Master\DataModulController;
use App\Http\Controllers\Admin\Master\DataPerpustakaanController;
use App\Http\Controllers\Admin\Master\DataUjianController;
use App\Http\Controllers\Admin\Master\DataVideoController;
use App\Http\Controllers\Admin\Master\DataZoomController;
use App\Http\Controllers\Admin\Master\Utama\KelasController;
use App\Http\Controllers\Admin\Master\Utama\SemesterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingController;
use App\Models\DataPerpustakaan;
use App\Models\DataUjian;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// LANDING PAGE
Route::get('/', [LandingController::class, 'index']);

// LOGIN DAN REGISTER
Route::get('login', [LoginController::class, 'login'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');

// REGISTER
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register/store', [RegisterController::class, 'store'])->name('register.store');

// LOGOUT
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// VERIFIKASI OTP
Route::get('/verify-otp/{user_id}', [RegisterController::class, 'showOtpForm'])->name('verify.otp');
Route::post('/verify-otp', [RegisterController::class, 'verifyOtp'])->name('verify.otp.submit');
Route::post('/resend-otp', [RegisterController::class, 'resendOtp'])->name('resend.otp');

// ADMIN
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ADMIN MASTER KELAS
    Route::get('admin/master/kelas', [KelasController::class, 'index'])->name('admin.kelas.index');
    Route::post('admin/master/kelas-tambah', [KelasController::class, 'tambah'])->name('admin.kelas.tambah');
    Route::put('admin/master/kelas-edit/{id}', [KelasController::class, 'edit'])->name('admin.kelas.edit');
    Route::delete('admin/master/kelas-hapus/{id}', [KelasController::class, 'hapus'])->name('admin.kelas.hapus');

    // SEMESTER
    Route::get('admin/master/semester', [SemesterController::class, 'index'])->name('admin.semester.index');
    Route::post('admin/master/semester-tambah', [SemesterController::class, 'tambah'])->name('admin.semester.tambah');
    Route::put('admin/master/semester-edit/{id}', [SemesterController::class, 'edit'])->name('admin.semester.edit');
    Route::delete('admin/master/semester-hapus/{id}', [SemesterController::class, 'hapus'])->name('admin.semester.hapus');


    // MASTER MODUL
    // INDEX
    Route::get('admin/master-modul', [DataModulController::class, 'index'])->name('admin.master.modul');
    // TAMBAH
    Route::get('admin/modul-tambah-tampil', [DataModulController::class, 'tampiltambah'])->name('admin.tampil-tambah');
    Route::post('admin/modul-tambah', [DataModulController::class, 'tambah'])->name('admin.modul.tambah');
    // CARI
    Route::get('admin/modul-cari', [DataModulController::class, 'cari'])->name('admin.modul-cari');
    // EDIT
    Route::get('admin/modul/ubah/{kdmodul}', [DataModulController::class, 'ubahmodul'])->name('admin.modul.ubahmodul');
    Route::put('admin/modul-edit/{kdmodul}', [DataModulController::class, 'ubah'])->name('admin.modul.ubah');
    // HAPUS
    Route::delete('admin/master/modul-hapus/{kdmodul}', [DataModulController::class, 'hapus'])->name('admin.modul.hapus');
    // UBAH STATUS
    Route::post('admin/modul/update-status', [DataModulController::class, 'updateStatus'])->name('modul.status');

    // MASTER VIDEO
    // INDEX
    Route::get('admin/master/datavideo', [DataVideoController::class, 'index'])->name('admin.master.video');
    // TAMBAH
    Route::get('admin/master/tambahvideo', [DataVideoController::class, 'tampiltambah'])->name('admin.master.video.tampil');
    Route::post('admin/master/tambah/video', [DataVideoController::class, 'tambahData'])->name('admin.master.video.tambah');
    // CARI
    Route::get('admin/video/cari', [DataVideoController::class, 'cariData'])->name('admin.video.cari');
    // EDIT
    Route::get('admin/master/video-tampiledit/{kdvideo}', [DataVideoController::class, 'tampiledit'])->name('admin.master.video.edit-tampil');
    Route::put('admin/master/video/edit/{kdvideo}', [DataVideoController::class, 'editData'])->name('admin.master.video.edit');
    // HAPUS
    Route::delete('admin/master/video-hapus/{kdvideo}', [DataVideoController::class, 'hapus'])->name('admin.master.video.hapus');
    // UBAH STATUS
    Route::post('admin/video/update-status', [DataVideoController::class, 'updateStatus'])->name('video.status');

    // MASTER ZOOM
    // INDEX
    Route::get('admin/master/datazoom', [DataZoomController::class, 'index'])->name('admin.master.zoom');
    // TAMBAH
    Route::get('admin/zoom/tampil', [DataZoomController::class, 'tampildata'])->name('admin.zoom.tampil');
    Route::post('admin/zoom/tambah', [DataZoomController::class, 'tambahdata'])->name('admin.zoom.tambah');
    // CARI
    Route::get('admin/zoom/cari', [DataZoomController::class, 'caridata'])->name('admin.zoom.cari');
    // EDIT
    Route::get('admin/zoom/ubah/{kdzoom}', [DataZoomController::class, 'tampiledit'])->name('admin.zoom.edit-tampil');
    Route::put('admin/zoom-edit/{kdzoom}', [DataZoomController::class, 'editdata'])->name('admin.zoom.edit');
    // HAPUS
    Route::delete('admin/zoom-hapus/{kdzoom}', [DataZoomController::class, 'hapus'])->name('admin.zoom.hapus');
    // STATUS
    Route::post('admin/zoom/update-status', [DataZoomController::class, 'updateStatus'])->name('zoom.status');

    // MASTER PERPUSTAKAAN
    // INDEX
    Route::get('admin/master/dataperpus', [DataPerpustakaanController::class, 'index'])->name('admin.master.perpus');
    // TAMBAH
    Route::get('admin/perpus/tampil', [DataPerpustakaanController::class, 'tampildata'])->name('admin.perpus.tampil');
    Route::post('admin/perpus/tambah', [DataPerpustakaanController::class, 'tambahdata'])->name('admin.perpus.tambah');
    // CARI
    Route::get('admin/perpus/cari', [DataPerpustakaanController::class, 'cari'])->name('admin.perpus.cari');
    // EDIT
    Route::get('admin/perpus/ubah/{kdperpus}', [DataPerpustakaanController::class, 'tampiledit'])->name('admin.perpus.edit-tampil');
    Route::put('admin/perpus-edit/{kdperpus}', [DataPerpustakaanController::class, 'editdata'])->name('admin.perpus.edit');
    // HAPUS
    Route::delete('admin/perpus-hapus/{kdperpus}', [DataPerpustakaanController::class, 'hapus'])->name('admin.perpus.hapus');
    //STATUS
    Route::post('admin/perpus/update-status', [DataPerpustakaanController::class, 'updateStatus'])->name('perpus.status');

    // MASTER KARYA MAHASISWA
    //INDEX
    Route::get('admin/master/datakarya', [DataKaryaController::class, 'index'])->name('admin.master.karya');
    //TAMBAH
    Route::get('admin/karya/tampil', [DataKaryaController::class, 'tampildata'])->name('admin.karya.tampil');
    Route::post('admin/karya/tambah', [DataKaryaController::class, 'tambahdata'])->name('admin.karya.tambah');
    // CARI
    Route::get('admin/karya/cari', [DataKaryaController::class, 'cari'])->name('admin.karya.cari');
    // EDIT
    Route::get('admin/karya/ubah/{kdkarya}', [DataKaryaController::class, 'tampiledit'])->name('admin.karya.edit-tampil');
    Route::put('admin/karya-edit/{kdkarya}', [DataKaryaController::class, 'editdata'])->name('admin.karya.edit');
    // HAPUS
    Route::delete('admin/karya-hapus/{kdkarya}', [DataKaryaController::class, 'hapus'])->name('admin.karya.hapus');
    // STATUS
    Route::post('admin/karya/update-status', [DataKaryaController::class, 'updateStatus'])->name('karya.status');

    // MASTER FORUM
    // INDEX
    Route::get('admin/master/dataforum', [DataForumController::class, 'index'])->name('admin.master.forum');
    // TAMBAH
    Route::get('admin/forum/tampil', [DataForumController::class, 'tampildata'])->name('admin.forum.tampil');
    Route::post('admin/forum/tambah', [DataForumController::class, 'tambahdata'])->name('admin.forum.tambah');
    // CARI
    Route::get('admin/forum/cari', [DataForumController::class, 'cari'])->name('admin.forum.cari');
    // EDIT
    Route::get('admin/forum/ubah/{kdforum}', [DataForumController::class, 'tampiledit'])->name('admin.forum.edit-tampil');
    Route::put('admin/forum-edit/{kdforum}', [DataForumController::class, 'editdata'])->name('admin.forum.edit');
    // HAPUS
    Route::delete('admin/forum-hapus/{kdforum}', [DataForumController::class, 'hapus'])->name('admin.forum.hapus');

    // MASTER UJIAN
    // INDEX
    Route::get('admin/master/dataujian', [DataUjianController::class, 'index'])->name('admin.master.ujian');
    // TAMBAH
    Route::get('admin/ujian/tampil', [DataUjianController::class, 'tampildata'])->name('admin.ujian.tampil');
    Route::post('admin/ujian/tambah', [DataUjianController::class, 'tambahdata'])->name('admin.master.tambah');
    // CARI
    Route::get('admin/ujian/cari', [DataUjianController::class, 'cari'])->name('admin.ujian.cari');
    // EDIT
    Route::get('admin/ujian/ubah/{kdujian}', [DataUjianController::class, 'tampiledit'])->name('admin.ujian.edit-tampil');
    Route::put('admin/ujian-edit/{kdujian}', [DataUjianController::class, 'editdata'])->name('admin.ujian.edit');
    // HAPUS
    Route::delete('admin/ujian-hapus/{kdujian}', [DataUjianController::class, 'hapus'])->name('admin.ujian.hapus');
    // STATUS
    Route::post('admin/ujian/update-status', [DataUjianController::class, 'updateStatus'])->name('ujian.status');
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('dosen/dashboard', [LandingController::class, 'dosen'])->name('dosen.dashboard');
});

Route::middleware(['auth', 'role:mahasiswa'])->group(function () {
    Route::get('mahasiswa/dashboard', [LandingController::class, 'index'])->name('mahasiswa.dashboard');
});
// USER
