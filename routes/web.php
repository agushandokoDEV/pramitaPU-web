<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthLogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\TabungController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\AmbilbahanController;
use App\Http\Controllers\AntarBahanController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\PengantaranDokterController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\JenisUraianPekerjaanController;

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

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/',[AuthController::class,'index'])->name('login');
Route::get('/register',[AuthController::class,'register']);
Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/logout',[AuthController::class,'authLogout'])->name('logout');
    Route::get('/home',[HomeController::class,'index'])->name('home.index');
    Route::get('/users',[UsersController::class,'index'])->name('users.index');
    Route::get('/users/all',[UsersController::class,'all'])->name('users.all');
    Route::get('/users/row/{id}',[UsersController::class,'byId'])->name('users.byId');
    Route::post('/users/add',[UsersController::class,'add'])->name('users.add');
    Route::post('/users/edit',[UsersController::class,'edit'])->name('users.edit');
    
    Route::get('/roles',[RolesController::class,'index'])->name('roles.index');
    Route::get('/roles/all',[RolesController::class,'all'])->name('roles.all');

    Route::get('/tabung',[TabungController::class,'index'])->name('tabung.index');
    Route::get('/tabung/all',[TabungController::class,'all'])->name('tabung.all');
    
    Route::get('/lab',[LabController::class,'index'])->name('lab.index');
    Route::get('/lab/all',[LabController::class,'all'])->name('lab.all');

    Route::get('/dokter',[DokterController::class,'index'])->name('dokter.index');
    Route::get('/dokter/all',[DokterController::class,'all'])->name('dokter.all');

    Route::get('/jenisuraianpekerjaan',[JenisUraianPekerjaanController::class,'index'])->name('jenisuraianpekerjaan.index');
    Route::get('/jenisuraianpekerjaan/all',[JenisUraianPekerjaanController::class,'all'])->name('jenisuraianpekerjaan.all');

    Route::get('/ambilbahan',[AmbilbahanController::class,'index'])->name('ambilbahan.index');
    Route::get('/ambilbahan/all',[AmbilbahanController::class,'all'])->name('ambilbahan.all');
    Route::get('/ambilbahan/tabung/{id}',[AmbilbahanController::class,'tabung'])->name('ambilbahan.tabung');
    Route::post('/ambilbahan/approved/{id}',[AmbilbahanController::class,'approved'])->name('ambilbahan.approved');
    Route::get('/ambilbahan/byid/{id}',[AmbilbahanController::class,'byid'])->name('ambilbahan.byid');

    Route::get('/antarbahan',[AntarBahanController::class,'index'])->name('antarbahan.index');
    Route::get('/antarbahan/all',[AntarBahanController::class,'all'])->name('antarbahan.all');

    Route::get('/instansi',[InstansiController::class,'index'])->name('instansi.index');
    Route::get('/instansi/all',[InstansiController::class,'all'])->name('instansi.all');

    Route::get('/lain-lain',[PengantaranDokterController::class,'index'])->name('pengantarandokter.index');
    Route::get('/lain-lain/all',[PengantaranDokterController::class,'all'])->name('pengantarandokter.all');
});