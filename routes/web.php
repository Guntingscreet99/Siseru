<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Master\DataHasilController;
use App\Http\Controllers\Admin\Master\DataKaryaController;
use App\Http\Controllers\Admin\Master\DataModulController;
use App\Http\Controllers\Admin\Master\DataPerpustakaanController;
use App\Http\Controllers\Admin\Master\DataVideoController;
use App\Http\Controllers\Admin\Master\DataZoomController;
use App\Http\Controllers\LandingController;
use App\Models\DataPerpustakaan;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// LANDING PAGE
Route::get('/', [LandingController::class, 'index']);

// ADMIN
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

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

// MASTER KARYA MAHASISWA
//INDEX
Route::get('admin/master/datakarya', [DataKaryaController::class, 'index'])->name('admin.master.karya');
//TAMBAH
Route::get('admin/karya/tampil', [DataKaryaController::class, 'tampildata'])->name('admin.karya.tampil');
Route::put('admin/karya/tambah', [DataKaryaController::class, 'tambahdata'])->name('admin.karya.tambah');
// CARI
Route::get('admin/karya/cari', [DataKaryaController::class, 'cari'])->name('admin.karya.cari');
// EDIT
Route::get('admin/karya/ubah/{kdkarya}', [DataKaryaController::class, 'tampiledit'])->name('admin.karya.edit-tampil');
Route::put('admin/karya-edit/{kdkarya}', [DataKaryaController::class, 'editdata'])->name('admin.karya.edit');
// HAPUS
Route::delete('admin/karya-hapus/{kdkarya}', [DataKaryaController::class, 'hapus'])->name('admin.karya.hapus');

// USER

