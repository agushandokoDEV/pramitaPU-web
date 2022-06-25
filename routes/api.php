<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\AmbilBahanController;

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
Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/account',[AuthController::class,'account'])->name('account');
    Route::post('/account/logout',[AuthController::class,'logout'])->name('logout');

    Route::get('/lab',[AmbilBahanController::class,'lab'])->name('lab.list');
    Route::get('/tabung',[AmbilBahanController::class,'tabung'])->name('tabung.list');
    Route::post('/ambil-bahan',[AmbilBahanController::class,'setAmbilbahan'])->name('ambilbahan');
});