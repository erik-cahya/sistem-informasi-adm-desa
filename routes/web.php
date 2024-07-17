<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AnnounceController;
use App\Models\Announce;

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
    return redirect()->route('beranda');
});

//CLIENT SIDE
//HOMEPAGE
Route::get('beranda', [LandingController::class, 'index'])->name('beranda');
//TENTANG KAMI
Route::get('/tentang-kami', [LandingController::class, 'about']);
//PROFIL DESA
Route::get('/visi-misi', [LandingController::class, 'visimisi']);
Route::get('/sejarah-desa', [LandingController::class, 'sejarahdesa']);
Route::get('/geografi-desa', [LandingController::class, 'geografidesa']);
Route::get('/demografi-desa', [LandingController::class, 'demografidesa']);
Route::get('/struktur-desa', [LandingController::class, 'strukturdesa']);
Route::get('/pemerintahan-desa', [LandingController::class, 'pemerintahandesa']);
Route::get('/lembaga-desa', [LandingController::class, 'lembagadesa']);
Route::get('/karang-taruna', [LandingController::class, 'karangtaruna']);
//BERITA-PENGUMUMAN-UNDUHAN-PRODUKHUKUM
Route::get('/berita-desa', [LandingController::class, 'beritadesa']);
Route::get('/berita-desa/category/{category}', [LandingController::class, 'beritadesa_cat']);
Route::get('/pengumumandepan', [LandingController::class, 'pengumumandepan']);
Route::get('/unduhan', [LandingController::class, 'unduhan']);
Route::get('/produk-hukum', [LandingController::class, 'produkhukum']);
//DETAIL
Route::get('/berita-desa/read/{news}', [LandingController::class, 'beritadesa_detail']);
Route::get('/berita-desa/category/read/{news}', [LandingController::class, 'beritadesa_detail']);
Route::get('/pengumuman/read/{announce}', [LandingController::class, 'pengumuman_detail']);
//APBDES
Route::get('/apbdes', [LandingController::class, 'apbdes']);

// Login Register Authentication
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login.check');

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerProcess'])->name('create.account');


Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}/{emailCrypt}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {

    Route::group(['middleware' => ['notAdmin']], function () {

        Route::get('home', [HomeController::class, 'index'])->name('home');
        Route::get('home/get/count/data/{by}', [HomeController::class, 'getCountData'])->name('home.getCountData');
        Route::get('home/get/count/gender', [HomeController::class, 'getGenderData'])->name('home.getCountGender');
        Route::get('home/get/count/mutasi', [HomeController::class, 'sortMonth'])->name('home.getCountMutasi');


        Route::get('user', [UserController::class, 'index'])->name('users');
        Route::get('users/{id}', [UserController::class, 'show'])->name('user.show');
        Route::post('user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('users/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('users/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
        Route::post('profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update.password');

        Route::get('parameter', [ParameterController::class, 'index'])->name('parameters');
        Route::get('parameters/{id}', [ParameterController::class, 'show'])->name('parameter.show');
        Route::post('parameter/create', [ParameterController::class, 'create'])->name('parameter.create');
        Route::post('parameters/update', [ParameterController::class, 'update'])->name('parameter.update');
        Route::delete('parameters/delete/{id}', [ParameterController::class, 'delete'])->name('parameter.delete');

        Route::get('warga', [WargaController::class, 'index'])->name('wargas')->middleware('notAdmin');
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

        //KATEGORI BERITA
        Route::get('kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::get('kategori/get', [KategoriController::class, 'show'])->name('kategori.show');
        Route::get('kategori/get/{id}', [KategoriController::class, 'show'])->name('kategori.show');
        Route::post('kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('kategori/update', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('kategori/delete/{id}', [KategoriController::class, 'delete'])->name('kategori.delete');
        //MANAJEMEN BERITA
        Route::get('berita', [BeritaController::class, 'index'])->name('berita');
        Route::get('berita/add', [BeritaController::class, 'add'])->name('berita.add');
        Route::post('berita/create/', [BeritaController::class, 'create'])->name('berita.create');
        Route::get('berita/edit/{id}', [BeritaController::class, 'edit'])->name('berita.edit');
        Route::post('berita/update', [BeritaController::class, 'update'])->name('berita.update');
        Route::delete('berita/delete/{id}', [BeritaController::class, 'delete'])->name('berita.delete');
        //MANAJEMEN PENGUMUMAN
        Route::get('pengumuman', [AnnounceController::class, 'index'])->name('pengumuman');
        Route::get('pengumuman/add', [AnnounceController::class, 'add'])->name('pengumuman.add');
        Route::post('pengumuman/create/', [AnnounceController::class, 'create'])->name('pengumuman.create');
        Route::get('pengumuman/edit/{id}', [AnnounceController::class, 'edit'])->name('pengumuman.edit');
        Route::post('pengumuman/update', [AnnounceController::class, 'update'])->name('pengumuman.update');
        Route::delete('pengumuman/delete/{id}', [AnnounceController::class, 'delete'])->name('pengumuman.delete');
    });

    // Surat Warga
    Route::get('pengajuan-surat', [SuratController::class, 'pengajuanSurat'])->name('pengajuan-surat');
    Route::get('pengajuan-surat/get', [SuratController::class, 'show'])->name('pengajuan-surat.show');
    Route::get('pengajuan-surat/get/{id}', [SuratController::class, 'show'])->name('pengajuan-surat.show');

    Route::post('pengajuan-surat', [SuratController::class, 'createPengajuanSurat'])->name('pengajuan-surat.create');
    Route::get('surat-saya', [SuratController::class, 'suratSaya'])->name('surat-saya');
    Route::get('list-pengajuan', [SuratController::class, 'listPengajuan'])->name('list-pengajuan');
    Route::delete('pengajuan-surat/delete/{id}', [SuratController::class, 'deletePengajuanSurat'])->name('pengajuan-surat.delete');
    Route::post('pengajutan-surat/update', [SuratController::class, 'update'])->name('pengajuan-surat.update');
});
