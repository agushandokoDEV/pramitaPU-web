<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\LabController;
use App\Http\Controllers\API\TabungController;
use App\Http\Controllers\API\AmbilBahanController;
use App\Http\Controllers\API\KegiatanController;
use App\Http\Controllers\API\AntarBahanController;
use App\Http\Controllers\API\InstansiController;
use App\Http\Controllers\API\PengantaranDokterController;
use App\Http\Controllers\API\JobLainnyaController;
use App\Http\Controllers\API\JenisUraianPekerjaanController;
use App\Http\Controllers\API\DokterController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/authenticate',[AuthController::class,'authenticate'])->name('authenticate');
Route::post('/authenticate/register',[AuthController::class,'register'])->name('register');

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/account',[AuthController::class,'account'])->name('account');
    Route::post('/account/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/lab',[LabController::class,'list'])->name('lab.list');
    Route::get('/tabung',[TabungController::class,'list'])->name('tabung.list');
    Route::get('/dokter',[DokterController::class,'list'])->name('dokter.list');
    Route::post('/ambil-bahan',[AmbilBahanController::class,'Add'])->name('ambilbahan.add');
    Route::post('/antar-bahan',[AntarBahanController::class,'Add'])->name('antarbahan.add');
    Route::post('/instansi',[InstansiController::class,'Add'])->name('instansi.add');
    Route::post('/pengantarandokter',[PengantaranDokterController::class,'Add'])->name('pengantarandokter.add');
    Route::post('/lainnya',[JobLainnyaController::class,'Add'])->name('lainnya.add');
    Route::get('/kegiatan',[KegiatanController::class,'bydate'])->name('kegiatan.bydate');
    Route::get('/riwayat-kegiatan',[KegiatanController::class,'riwayat'])->name('kegiatan.riwayat');
    Route::get('/kegiatan/{id}',[KegiatanController::class,'byid'])->name('kegiatan.byid');
    Route::get('/jenis-uraian-pekerjaan',[JenisUraianPekerjaanController::class,'list'])->name('jenisuraianpekerjaan.list');
});