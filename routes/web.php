<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Master\DataForumController;
use App\Http\Controllers\Admin\Master\DataHasilController;
use App\Http\Controllers\Admin\Master\DataKaryaController;
use App\Http\Controllers\Admin\Master\DataModulController;
use App\Http\Controllers\Admin\Master\DataPeringkatController;
use App\Http\Controllers\Admin\Master\DataPerpustakaanController;
use App\Http\Controllers\Admin\Master\DataUjianController;
use App\Http\Controllers\Admin\Master\DataVideoController;
use App\Http\Controllers\Admin\Master\DataZoomController;
use App\Http\Controllers\Admin\Master\Utama\KelasController;
use App\Http\Controllers\Admin\Master\Utama\SemesterController;
use App\Http\Controllers\Admin\Master\Utama\UserController;
use App\Http\Controllers\Admin\Rekap\RekapDiskusiController;
use App\Http\Controllers\Admin\Rekap\RekapKaryaController;
use App\Http\Controllers\Admin\Rekap\RekapUjianController;
use App\Http\Controllers\Admin\Rekap\RekapController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Mahasiswa\IndexController;
use App\Http\Controllers\User\Menu\DataDiri\DatadiriController;
use App\Http\Controllers\User\Menu\Forum\DiskusiController;
use App\Http\Controllers\User\Menu\Galeri\GaleriController;
use App\Http\Controllers\User\Menu\Modul\ModulController;
use App\Http\Controllers\User\Menu\Forum\ForumController;
use App\Http\Controllers\User\Menu\Video\VideoController;
use App\Http\Controllers\User\Perpustakaan\PerpusController;
use App\Http\Controllers\User\Menu\Peringkat\PeringkatController;
use App\Http\Controllers\User\Menu\Ujian\UjianController;
use App\Http\Controllers\User\Menu\Zoom\ZoomController;
use App\Http\Controllers\User\UserDasboardController;
use App\Models\DataPerpustakaan;
use App\Models\DataUjian;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// LANDING PAGE
Route::get('/', [LandingController::class, 'index'])->name('landing.index');

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
    Route::get('admin/master/ujian', [DataUjianController::class, 'index'])->name('admin.ujian.index');
    // TAMBAH
    Route::get('admin/ujian-tambah-tampil', [DataUjianController::class, 'tampildata'])->name('admin.ujian.tampil');
    Route::post('admin/ujian-tambah', [DataUjianController::class, 'tambahdata'])->name('admin.ujian.tambah');
    // CARI
    Route::get('admin/ujian-cari', [DataUjianController::class, 'cari'])->name('admin.ujian.cari');
    // EDIT
    Route::get('admin/ujian/ubah/{ujian}', [DataUjianController::class, 'tampiledit'])->name('admin.ujian.edit-tampil');
    Route::put('admin/ujian-edit/{ujian}', [DataUjianController::class, 'editdata'])->name('admin.ujian.edit');
    // HAPUS
    Route::delete('admin/ujian-hapus/{ujian}', [DataUjianController::class, 'hapus'])->name('admin.ujian.hapus');
    // STATUS
    Route::post('admin/ujian/update-status', [DataUjianController::class, 'updateStatus'])->name('ujian.status');


    // MASTER PERINGKAT
    // INDEX
    Route::get('admin/master/dataperingkat', [DataPeringkatController::class, 'index'])->name('admin.master.peringkat');
    // TAMBAH
    Route::get('admin/peringkat/tampil', [DataPeringkatController::class, 'tampildata'])->name('admin.peringkat.tampil');
    Route::post('admin/peringkat/tambah', [DataPeringkatController::class, 'tambahdata'])->name('admin.peringkat.tambah');
    // CARI
    Route::get('admin/peringkat/cari', [DataPeringkatController::class, 'caridata'])->name('admin.peringkat.cari');
    // EDIT
    Route::get('admin/peringkat/ubah/{kdperingkat}', [DataPeringkatController::class, 'tampiledit'])->name('admin.peringkat.edit-tampil');
    Route::put('admin/peringkat-edit/{kdperingkat}', [DataPeringkatController::class, 'editdata'])->name('admin.peringkat.edit');
    // HAPUS
    Route::delete('admin/peringkat-hapus/{kdperingkat}', [DataPeringkatController::class, 'hapus'])->name('admin.peringkat.hapus');
    // STATUS
    Route::post('admin/peringkat/update-status', [DataPeringkatController::class, 'updateStatus'])->name('peringkat.status');

    // REKAP FORUM
    Route::get('admin/forum/rekap/{kdforum}', [ForumController::class, 'lihatRekap'])->name('admin.forum.rekap');
    Route::get('admin/forum/rekap-download/{kdforum}', [ForumController::class, 'downloadRekap'])->name('admin.forum.rekap.download');
    Route::get('admin/rekap-diskusi', [RekapDiskusiController::class, 'index'])->name('admin.rekap.diskusi');
    Route::get('admin/rekap/forum', [RekapDiskusiController::class, 'index'])->name('admin.rekap.forum');

    // REKAP DATA
    Route::get('admin/rekap-index', [RekapController::class, 'index'])->name('admin.rekap.index');
    Route::post('admin/rekap/generete', [RekapController::class, 'generateRekap'])->name('admin.rekap.generate');
    Route::get('admin/rekap-export', [RekapController::class, 'export'])->name('rekap.export');


    // REKAP KARYA
    Route::get('/admin/rekap-karya', [App\Http\Controllers\Admin\Rekap\RekapKaryaController::class, 'index'])->name('admin.rekap.karya');
    Route::get('/admin/rekap-karya/{kdkarya}/edit', [App\Http\Controllers\Admin\Rekap\RekapKaryaController::class, 'edit'])->name('admin.rekap.karya.edit');
    Route::put('/admin/rekap-karya/{kdkarya}', [App\Http\Controllers\Admin\Rekap\RekapKaryaController::class, 'update'])->name('admin.rekap.karya.update');

    // REKAP UJIAN
    Route::prefix('admin')->middleware('auth')->group(function () {

        Route::get('/rekap/ujian', [RekapUjianController::class, 'index'])
            ->name('admin.rekap.ujian');

        Route::post('/rekap/ujian/import', [RekapUjianController::class, 'import'])
            ->name('admin.rekap.ujian.import');

        Route::post('/rekap/ujian/format', [RekapUjianController::class, 'format'])
            ->name('admin.rekap.format');

        Route::delete('/rekap/ujian/{kdujian}', [RekapUjianController::class, 'destroy'])
            ->name('admin.rekap.ujian.destroy');
    });

    Route::get('admin/master/akun', [UserController::class, 'index'])->name('admin.user.index');
});

Route::middleware(['auth', 'role:dosen'])->group(function () {
    Route::get('dosen/dashboard', [LandingController::class, 'dosen'])->name('dosen.dashboard');
});

Route::middleware(['auth', 'role:mahasiswa', 'mahasiswa.activity'])->group(function () {
    Route::get('mahasiswa/dashboard', [UserDasboardController::class, 'index'])->name('mahasiswa.dashboard');

    // DATA DIRI
    Route::get('mahasiswa/data-diri', [DatadiriController::class, 'create'])->name('mahasiswa.data-diri');
    Route::post('mahasiswa/data-diri/simpan/{id}', [DatadiriController::class, 'simpan'])->name('mahasiswa.data-diri.simpan');

    // GALERI KARYA (User)
    Route::middleware('auth')->group(function () {

        Route::get('user/menu/galeri', [GaleriController::class, 'index'])
            ->name('user.galeri.index');

        Route::get('user/galeri/cari', [GaleriController::class, 'cariData'])
            ->name('user.galeri.cari');

        // Tambah
        Route::get('user/menu/galeri/tampil', [GaleriController::class, 'tampildata'])
            ->name('user.galeri.tampil');
        Route::post('user/menu/galeri/tambah', [GaleriController::class, 'tambahdata'])
            ->name('user.galeri.tambah');

        // Edit
        Route::get('user/galeri/ubah/{kdkarya}', [GaleriController::class, 'tampiledit'])
            ->name('user.galeri.edit-tampil');
        Route::put('user/galeri-edit/{kdkarya}', [GaleriController::class, 'editdata'])
            ->name('user.galeri.edit');

        // Hapus
        Route::delete('user/galeri-hapus/{kdkarya}', [GaleriController::class, 'hapus'])
            ->name('user.galeri.hapus');
    });

    // Modul
    // INDEX
    Route::get('user/menu/modul', [ModulController::class, 'index'])->name('user.modul.index');
    // CARI
    Route::get('user/modul/cari', [ModulController::class, 'cariData'])->name('user.modul.cari');
    // TAMBAH
    Route::get('user/menu/modul/tampil', [ModulController::class, 'tampildata'])->name('user.modul.tampil');
    Route::post('user/menu/modul/tambah', [ModulController::class, 'tambahdata'])->name('user.modul.tambah');
    // EDIT
    Route::get('user/modul/ubah/{kdmodul}', [ModulController::class, 'tampiledit'])->name('user.modul.edit-tampil');
    Route::put('user/modul-edit/{kdmodul}', [ModulController::class, 'editdata'])->name('user.modul.edit');
    // HAPUS
    Route::delete('user/modul-hapus/{kdmodul}', [ModulController::class, 'hapus'])->name('user.modul.hapus');

    // FORUM
    // INDEX
    Route::get('user/menu/forum', [ForumController::class, 'index'])->name('user.forum.index');
    // CARI
    Route::get('user/forum/cari', [ForumController::class, 'cariData'])->name('user.forum.cari');
    // TAMBAH
    Route::get('user/menu/forum/tampil', [ForumController::class, 'tampildata'])->name('user.forum.tampil');
    Route::post('user/menu/forum/tambah', [ForumController::class, 'tambahdata'])->name('user.forum.tambah');
    // EDIT
    Route::get('user/forum/ubah/{id}', [ForumController::class, 'tampiledit'])->name('user.forum.edit-tampil');
    Route::put('user/forum-edit/{id}', [ForumController::class, 'editdata'])->name('user.forum.edit');
    // HAPUS
    Route::delete('user/forum-hapus/{id}', [ForumController::class, 'hapus'])->name('user.forum.hapus');

    // DISKUSI
    Route::middleware('auth')->group(function () {

        // Halaman utama diskusi (yang pakai Blade kita tadi)
        Route::get('/diskusi', [DiskusiController::class, 'index'])
            ->name('diskusi.index');                     // http://localhost/diskusi

        // AJAX: Load semua pesan
        Route::get('/diskusi/{kdforum}/pesan', [DiskusiController::class, 'pesan'])
            ->name('diskusi.pesan');                     // /diskusi/ABC123/pesan

        // AJAX: Kirim pesan baru
        Route::post('/diskusi/kirim', [DiskusiController::class, 'kirim'])
            ->name('diskusi.kirim');                     // /diskusi/kirim

        // AJAX: Lihat rekap diskusi (text)
        // Route::get('/diskusi/rekap/{kdforum}', function ($kdforum) {
        //     $rekap = \App\Models\RekapForum::where('kdforum', $kdforum)->first();
        //     if (!$rekap) {
        //         return 'Rekap belum tersedia. Diskusi mungkin belum ditutup otomatis.';
        //     }
        //     return response($rekap->isi_rekap, 200, [
        //         'Content-Type' => 'text/plain; charset=utf-8'
        //     ]);
        // })->name('diskusi.rekap');                       // /diskusi/rekap/ABC123
    });

    // Video
    // INDEX
    Route::get('user/menu/video', [VideoController::class, 'index'])->name('user.video.index');
    // CARI
    Route::get('user/video/cari', [VideoController::class, 'cariData'])->name('user.video.cari');
    // TAMBAH
    Route::get('user/video/tampil', [VideoController::class, 'tampildata'])->name('user.video.tampil');
    Route::post('user/video/tambah', [VideoController::class, 'tambahdata'])->name('user.video.tambah');
    // EDIT
    Route::get('user/video/ubah/{id}', [VideoController::class, 'tampiledit'])->name('user.video.edit-tampil');
    Route::put('user/video/-edit/{id}', [VideoController::class, 'editdata'])->name('user.video.edit');
    // HAPUS
    Route::delete('user/video-hapus/{id}', [VideoController::class, 'hapus'])->name('user.video.hapus');

    // UJIAN
    // INDEX
    Route::get('user/menu/ujian', [UjianController::class, 'index'])->name('user.ujian.index');
    // CARI
    Route::get('user/ujian/cari', [UjianController::class, 'cariData'])->name('user.ujian.cari');


    // PERPUSTAKAAN
    // INDEX
    Route::get('user/menu/perpus', [PerpusController::class, 'index'])->name('user.perpus.index');
    // CARI
    Route::get('user/perpus/cari', [PerpusController::class, 'cariData'])->name('user.perpus.cari');
    // TAMBAH
    Route::get('user/perpus/tampil', [PerpusController::class, 'tampildata'])->name('user.perpus.tampil');
    Route::post('user/perpus/tambah', [PerpusController::class, 'tambahdata'])->name('user.perpus.tambah');
    // EDIT
    Route::get('user/perpus/ubah/{id}', [PerpusController::class, 'tampiledit'])->name('user.perpus.edit-tampil');
    Route::put('user/perpus-edit/{id}', [PerpusController::class, 'editdata'])->name('user.perpus.edit');
    // HAPUS
    Route::delete('user/perpus-hapus/{id}', [PerpusController::class, 'hapus'])->name('user.perpus.hapus');

    // PERINGKAT
    // INDEX
    Route::get('user/menu/peringkat', [PeringkatController::class, 'index'])->name('user.peringkat.index');
    // CARI
    Route::get('user/peringkat/cari', [PeringkatController::class, 'cariData'])->name('user.peringkat.cari');
    // TAMBAH
    Route::get('user/peringkat/tampil', [PeringkatController::class, 'tampildata'])->name('user.peringkat.tampil');
    Route::post('user/peringkat/tambah', [PeringkatController::class, 'tambahdata'])->name('user.peringkat.tambah');
    // EDIT
    Route::get('user/peringkat/ubah/{id}', [PeringkatController::class, 'tampiledit'])->name('user.peringkat.edit-tampil');
    Route::put('user/peringkat-edit/{id}', [PeringkatController::class, 'editdata'])->name('user.peringkat.edit');
    // HAPUS
    Route::delete('user/peringkat-hapus/{id}', [PeringkatController::class, 'hapus'])->name('user.peringkat.hapus');

    // ZOOM
    // INDEX
    Route::get('user/menu/zoom', [ZoomController::class, 'index'])->name('user.menu.zoom');
    // CARI
    Route::get('user/zoom/cari', [ZoomController::class, 'cari'])->name('user.zoom.cari');
    // TAMBAH
    Route::get('user/zoom/tampil', [ZoomController::class, 'tampildata'])->name('user.zoom.tampil');
    Route::post('user/zoom/tambah', [ZoomController::class, 'tambahdata'])->name('user.zoom.tambah');
    // EDIT
    Route::get('user/zoom/ubah/{kdzoom}', [ZoomController::class, 'tampiledit'])->name('user.zoom.edit-tampil');
    Route::put('user/zoom-edit/{kdzoom}', [ZoomController::class, 'editdata'])->name('user.zoom.edit');
    // HAPUS
    Route::delete('user/zoom-hapus/{kdzoom}', [ZoomController::class, 'hapus'])->name('user.zoom.hapus');
    // STATUS
    Route::post('user/zoom/update-status', [ZoomController::class, 'updateStatus'])->name('user.zoom.status');
});
// USER
