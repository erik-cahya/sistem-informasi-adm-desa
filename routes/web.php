<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\SuratController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   return redirect()->route('home');
});

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.check');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('user', [UserController::class, 'index'])->name('users');
    Route::get('users/{id}', [UserController::class, 'show'])->name('user.show');
    Route::post('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('users/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('users/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

    Route::get('parameter', [ParameterController::class, 'index'])->name('parameters');
    Route::get('parameters/{id}', [ParameterController::class, 'show'])->name('parameter.show');
    Route::post('parameter/create', [ParameterController::class, 'create'])->name('parameter.create');
    Route::post('parameters/update', [ParameterController::class, 'update'])->name('parameter.update');
    Route::delete('parameters/delete/{id}', [ParameterController::class, 'delete'])->name('parameter.delete');
    
    Route::get('warga', [WargaController::class, 'index'])->name('wargas');
    Route::get('warga/{id}', [WargaController::class, 'show'])->name('warga.show');
    Route::post('warga/create', [WargaController::class, 'create'])->name('warga.create');
    Route::post('warga/update', [WargaController::class, 'update'])->name('warga.update');
    Route::delete('warga/delete/{id}', [WargaController::class, 'delete'])->name('warga.delete');

    Route::get('keluarga', [KeluargaController::class, 'index'])->name('keluargas');
    Route::get('keluarga/get', [KeluargaController::class, 'show'])->name('keluarga.show');
    Route::get('keluarga/get/{id}', [KeluargaController::class, 'show'])->name('keluarga.show');
    Route::post('keluarga/create', [KeluargaController::class, 'create'])->name('keluarga.create');
    Route::post('keluarga/update', [KeluargaController::class, 'update'])->name('keluarga.update');
    Route::delete('keluarga/delete/{id}', [KeluargaController::class, 'delete'])->name('keluarga.delete');

    Route::post('mutasi/create', [MutasiController::class, 'create'])->name('mutasi.create');
    Route::get('mutasi/keluar', [MutasiController::class, 'mutasiKeluar'])->name('mutasi.keluar');
    Route::get('mutasi/masuk', [MutasiController::class, 'mutasiMasuk'])->name('mutasi.masuk');
    Route::get('mutasi', [MutasiController::class, 'index'])->name('mutasi');
    Route::get('mutasi/get', [MutasiController::class, 'show'])->name('mutasi.show');
    Route::get('mutasi/get/{id}', [MutasiController::class, 'show'])->name('mutasi.show');
    Route::delete('mutasi/delete/{id}', [MutasiController::class, 'delete'])->name('mutasi.delete');
    Route::post('mutasi/update', [MutasiController::class, 'update'])->name('mutasi.update');
    
    Route::get('surat', [SuratController::class, 'index'])->name('surats');
    Route::delete('surat/delete/{id}', [SuratController::class, 'delete'])->name('surat.delete');
    Route::get('surat/download/{fileName}', [SuratController::class, 'getFile'])->name('surat.download');
    
    Route::get('buat-surat/domisili', [SuratController::class, 'suratDomisili'])->name('surat.domisili');
    Route::post('surat/domisili/create', [SuratController::class, 'createSuratDomisili'])->name('surat.domisili.create');

    Route::get('buat-surat/keterangan-pekerjaan-orang-tua', [SuratController::class, 'suratKeteranganPekerjaanOrangTua'])->name('surat.keterangan_pekerjaan_orang_tua');
    Route::post('surat/keterangan-pekerjaan-orang-tua/create', [SuratController::class, 'createSuratKeteranganPekerjaanOrangTua'])->name('surat.keterangan_pekerjaan_orang_tua.create');
   
    Route::get('buat-surat/keterangan-berlakuan-baik', [SuratController::class, 'suratKeteranganBerlakuanBaik'])->name('surat.keterangan_berlakuan_baik');
    Route::post('surat/keterangan-berlakuan-baik/create', [SuratController::class, 'createsuratKeteranganBerlakuanBaik'])->name('surat.keterangan_berlakuan_baik.create');

    Route::get('buat-surat/keterangan-ekonomi-lemah', [SuratController::class, 'suratKeteranganEkonomiLemah'])->name('surat.keterangan_ekonomi_lemah');
    Route::post('surat/keterangan-ekonomi-lemah/create', [SuratController::class, 'createSuratKeteranganEkonomiLemah'])->name('surat.keterangan_ekonomi_lemah.create');

    Route::get('buat-surat/keterangan-belum-menikah', [SuratController::class, 'suratKeteranganBelumMenikah'])->name('surat.surat_keterangan_belum_menikah');
    Route::post('surat/keterangan-belum-menikah/create', [SuratController::class, 'createSuratKeteranganBelumMenikah'])->name('surat.surat_keterangan_belum_menikah.create');

    Route::get('buat-surat/keterangan-kepemilikan', [SuratController::class, 'suratKeteranganKepemilikan'])->name('surat.surat_keterangan_kepemilikan');
    Route::post('surat/keterangan-kepemilikan/create', [SuratController::class, 'createSuratKeteranganKepemilikan'])->name('surat.surat_keterangan_kepemilikan.create');

    Route::get('buat-surat/keterangan-usaha', [SuratController::class, 'suratKeteranganUsaha'])->name('surat.surat_keterangan_usaha');
    Route::post('surat/keterangan-usaha/create', [SuratController::class, 'createSuratKeteranganUsaha'])->name('surat.surat_keterangan_usaha.create');
});