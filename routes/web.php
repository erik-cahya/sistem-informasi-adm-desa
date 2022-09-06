<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\MutasiController;

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
    
});