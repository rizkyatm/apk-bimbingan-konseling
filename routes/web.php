<?php

use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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


Route::get("/", [LandingpageController::class, "landing"]);

Route::get('/login', function () { return view('login');})->name('login');//halaman login
Route::post('/postlogin',[LoginController::class, 'postlogin'])->name('postlogin');//backend login
Route::get( '/logout',[LoginController::class, 'logout'])->name('logout');//backend logout


Route::group(['middleware' => ['auth']], function () {
    //////////////////////////////////////////akun admin start//////////////////////////////////////////
        Route::get('/admin', [AdminController::class, 'admin'])->middleware('checkRole:admin');
        Route::get('/akunGuru', [AdminController::class, 'akunGuru'])->name('akunGuru')->middleware('checkRole:admin');
        Route::get('/tambahdataguru', [AdminController::class, 'tambahdataguru'])->middleware('checkRole:admin');
        Route::get('/tambahkelas', [AdminController::class, 'tambahkelas'])->middleware('checkRole:admin');
        Route::post('/insertdataguru', [AdminController::class, 'insertdataguru'])->middleware('checkRole:admin');
        Route::get('/tampilkandataguru/{id}', [AdminController::class, 'tampilkandataguru'])->middleware('checkRole:admin');
        Route::post('/updatedataguru/{id}', [AdminController::class, 'updatedataguru'])->middleware('checkRole:admin');
        Route::get('/deletedataguru/{id}', [AdminController::class, 'deletedataguru'])->middleware('checkRole:admin');
    
        // siswa
        Route::get('/siswa', [AdminController::class, 'datasiswa'])->name('datasiswa')->middleware('checkRole:admin');
        Route::get('/tambahsiswa', [AdminController::class, 'tambahsiswa'])->middleware('checkRole:admin');
        Route::post('/insertdatasiswa', [AdminController::class, 'insertdatasiswa'])->middleware('checkRole:admin');
        Route::get('/tampilkandatasiswa/{id}', [AdminController::class, 'tampilkandatasiswa'])->middleware('checkRole:admin');
        Route::post('/updatedatasiswa/{id}', [AdminController::class, 'updatedatasiswa'])->middleware('checkRole:admin');
        Route::get('/deletedatasiswa/{id}', [AdminController::class, 'deletedatasiswa'])->middleware('checkRole:admin');
    
        // kelas
        Route::get('/kelas', [AdminController::class, 'kelas'])->name('kelas')->middleware('checkRole:admin');
        Route::post('/insertdatakelas', [AdminController::class, 'insertdatakelas'])->name('insertdatakelas')->middleware('checkRole:admin');
        Route::get('/deletedatakelas/{id}', [AdminController::class, 'deletedatakelas'])->name('deletedatakelas')->middleware('checkRole:admin');

        // Wali Kelas
        Route::get('/datawalikelas', [AdminController::class, 'datawalikelas'])->name('datawalikelas')->middleware('checkRole:admin');
        Route::get('/tambahdatawalikelas', [AdminController::class, 'tambahwalikelas'])->name('tambahwalikelas')->middleware('checkRole:admin');
        Route::post('/insertdatawalikelas', [AdminController::class, 'insertdatawalikelas'])->name('insertdatawalikelas')->middleware('checkRole:admin');
        Route::get('/tampilkandatawalikelas/{id}', [AdminController::class, 'tampilkadatawalikelas'])->middleware('checkRole:admin');
        Route::post('/updateDatawalikelas/{id}', [AdminController::class, 'updateDatawalikelas'])->middleware('checkRole:admin');
        Route::get('/deletedatawalikelas/{id}', [AdminController::class, 'deletedatawalikelas'])->middleware('checkRole:admin');

    //////////////////////////////////////////akun guru start///////////////////////////////////////////
        //profil
        Route::get('/guru', [GuruController::class, 'guru'])->name('guru')->middleware('checkRole:guru');
        Route::post('/updateprofilguru/{id}', [GuruController::class, 'updateprofilguru'])->middleware('checkRole:guru');

        //kelas siswa
        Route::get('/akunSiswa', [GuruController::class, 'akunSiswa'])->middleware('checkRole:guru');
        Route::get('/siswa/{kelasId}', [GuruController::class, 'menampikanmurid'])->middleware('checkRole:guru');//memampilkan murid sesuai login

        //buat jadwal
        Route::get('/buatJadwal', [GuruController::class, 'buatJadwal'])->middleware('checkRole:guru');
        Route::post('/getdatasiswa', [GuruController::class, 'getSiswaByKelas']);
        Route::post('/tambahjadwal', [GuruController::class, 'tambahjadwal'])->middleware('checkRole:guru');
        Route::post('/mundurkanjadwal/{id}', [GuruController::class, 'mundurkanjadwal'])->middleware('checkRole:guru');
        Route::post('/terimajadwal/{id}', [GuruController::class, 'terimajadwal'])->middleware('checkRole:guru');
        Route::post('/selesaikanjadwal/{id}', [GuruController::class, 'selesaikanjadwal'])->middleware('checkRole:guru');

        //History
        Route::get('/history', [GuruController::class, 'history'])->middleware('checkRole:guru');
    //////////////////////////////////////////akun guru end/////////////////////////////////////////////

    //////////////////////////////////////////akun siswa start//////////////////////////////////////////
        Route::get('/profilsiswa', [SiswaController::class, 'profilsiswa'])->middleware('checkRole:siswa');
        Route::get('/jadwal', [SiswaController::class, 'jadwal'])->name('jadwal')->middleware('checkRole:siswa');
        Route::get('/histori', [SiswaController::class, 'histori'])->middleware('checkRole:siswa');
        Route::post('/siswatambahJadwal', [SiswaController::class, 'siswatambahJadwal'])->middleware('checkRole:siswa');
   //////////////////////////////////////////akun siswa end////////////////////////////////////////////
});

     /////////////////////////////////////ExportExcel///////////////////////////////////////////
     Route::get('/exportguru', [AdminController::class, 'exportguru'])->name('exportguru');
     Route::get('/exportwalas', [AdminController::class, 'exportwalas'])->name('exportwalas');
     Route::get('/exportkelas', [AdminController::class, 'exportkelas'])->name('exportkelas');
     Route::get('/exportsiswa', [AdminController::class, 'exportsiswa'])->name('exportsiswa');
     

    // Route::post('/postlogin', 'LoginController@postlogin')->name('postlogin');
    // Route::get('/siswa',[SiswaController::class, 'siswa'])->name('siswa');