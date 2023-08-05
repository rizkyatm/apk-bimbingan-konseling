<?php

use App\Http\Controllers\API\LoginApiController;
use App\Http\Controllers\API\storeApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth/login',[LoginApiController::class, 'loginApi'])->name('loginApi');
Route::get('/auth/getdata',[LoginApiController::class, 'jadwal'])->name('jadwal');


// Tambah Jadwal 
Route::get('/createjadwal', [storeApiController::class, 'getDataAkun']);
Route::post('/createjadwal/storejadwal', [storeApiController::class, 'storeJadwal']);

//Profil Siswa
Route::get('/profilesiswa', [storeApiController::class, 'profileSiswa']);
