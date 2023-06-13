<?php

use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\WaliKelasController;
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
        Route::get('/Admin/Profile', [AdminController::class, 'profileAdmin'])->middleware('checkRole:admin'); //MENAMPILKAN PROFILE ADMIN

        // guru
        Route::get('/Admin/Guru', [AdminController::class, 'Guru'])->name('Guru')->middleware('checkRole:admin'); //MENAMPILKAN TABLE GURU BK
        Route::get('/Admin/TambahGuru', [AdminController::class, 'tambahdataguru'])->middleware('checkRole:admin'); //MENAMPILKAN FORM UNTUK MENAMBAHKAN DATA GURU BK
        Route::post('/Admin/insertGuru', [AdminController::class, 'insertGuru'])->middleware('checkRole:admin'); //UNTUK MEMASUKAN DATA GURU KEDALAM DATABASE (BACKEND)
        Route::get('TampilkanGuru/{id}', [AdminController::class, 'TampilkanGuru'])->middleware('checkRole:admin'); //UNTUK MENAMPILKAN FORM BESERTA VALUENYA SESUAI ID
        Route::post('/Admin/UpdateGuru/{id}', [AdminController::class, 'UpdateGuru'])->middleware('checkRole:admin'); //UNTUK MENGUPDATE DATA GURU KEDALAM DATABASE SESUAI ID (BACKEND)
        Route::get('/Admin/DeleteGuru/{id}', [AdminController::class, 'DeleteGuru'])->middleware('checkRole:admin');  //UNTUK HAPUS DATA GURU KEDALAM DATABASE SESUAI ID (BACKEND)
    
        // siswa
        Route::get('/Admin/Siswa', [AdminController::class, 'Siswa'])->name('Siswa')->middleware('checkRole:admin'); //MENAMPILKAN TABLE SISWA
        Route::get('/tambahsiswa', [AdminController::class, 'tambahsiswa'])->middleware('checkRole:admin'); 
        Route::post('/insertdatasiswa', [AdminController::class, 'insertdatasiswa'])->middleware('checkRole:admin');
        Route::get('/tampilkandatasiswa/{id}', [AdminController::class, 'tampilkandatasiswa'])->middleware('checkRole:admin');
        Route::post('/updatedatasiswa/{id}', [AdminController::class, 'updatedatasiswa'])->middleware('checkRole:admin');
        Route::get('/deletedatasiswa/{id}', [AdminController::class, 'deletedatasiswa'])->middleware('checkRole:admin');
    
        // kelas
        Route::get('/kelas', [AdminController::class, 'kelas'])->name('kelas')->middleware('checkRole:admin');
        Route::post('/insertdatakelas', [AdminController::class, 'insertdatakelas'])->name('insertdatakelas')->middleware('checkRole:admin');
        Route::get('/deletedatakelas/{id}', [AdminController::class, 'deletedatakelas'])->name('deletedatakelas')->middleware('checkRole:admin');
        Route::get('/tambahkelas', [AdminController::class, 'tambahkelas'])->middleware('checkRole:admin');

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
        //Profil
        Route::get('/profilsiswa', [SiswaController::class, 'profilsiswa'])->name('profilsiswa')->middleware('checkRole:siswa');
        Route::post('/updateprofilsiswa/{id}', [SiswaController::class, 'updateprofilsiswa'])->middleware('checkRole:siswa');

        //Jadwal Panggilan
        Route::get('/jadwal', [SiswaController::class, 'jadwal'])->name('jadwal')->middleware('checkRole:siswa');
        Route::post('/siswatambahJadwal', [SiswaController::class, 'siswatambahJadwal'])->middleware('checkRole:siswa');
        
        //Archives
        Route::get('/histori', [SiswaController::class, 'histori'])->middleware('checkRole:siswa');
   //////////////////////////////////////////akun siswa end////////////////////////////////////////////

    //////////////////////////////////////////akun wali kelas start//////////////////////////////////////////
        //Profil
        Route::get('/profilwalas', [WaliKelasController::class, 'profilwalas'])->name('profilwalas')->middleware('checkRole:wali_kelas');
        Route::post('/updateprofilwalikelas/{id}', [WaliKelasController::class, 'updateprofilwalikelas'])->middleware('checkRole:wali_kelas');
               
        
        //Jadwal Panggilan
        Route::get('/jadwalkonseling', [WaliKelasController::class, 'jadwalkonseling'])->middleware('checkRole:wali_kelas');
        Route::post('/imputhasilbelajar/{id}', [WaliKelasController::class, 'imputhasilbelajar'])->middleware('checkRole:wali_kelas');
        
        
        //hasil konseling
        Route::get('/hasilkonseling', [WaliKelasController::class, 'hasilkonseling'])->name('hasilkonseling')->middleware('checkRole:wali_kelas');
       
   //////////////////////////////////////////akun wali kelas end////////////////////////////////////////////
});

     /////////////////////////////////////ExportExcel///////////////////////////////////////////
     Route::get('/exportguru', [AdminController::class, 'exportguru'])->name('exportguru');
     Route::get('/exportwalas', [AdminController::class, 'exportwalas'])->name('exportwalas');
     Route::get('/exportkelas', [AdminController::class, 'exportkelas'])->name('exportkelas');
     Route::get('/exportsiswa', [AdminController::class, 'exportsiswa'])->name('exportsiswa');
     Route::get('/exportpetakerawanan', [AdminController::class, 'exportpetakerawanan'])->name('exportpetakerawanan');


    ////////////////////////////////////petakerawanan///////////////////////////////////////////
    Route::get('/adminpetakerawanan', [AdminController::class, 'petakerawanan'])->name('petakerawanan');
    Route::get('/tambahpelanggaran', [AdminController::class, 'tambahpelanggaran'])->name('tambahpelanggaran');
    Route::post('/insertpetakerawanan', [AdminController::class, 'insertpetakerawanan'])->name('insertpetakerawanan');
    Route::get('/deletepetakerawanan/{id}', [AdminController::class, 'deletepetakerawanan'])->name('deletepetakerawanan');
     

    //petapelanggaran/guru////
    Route::get('/petakerawanan', [GuruController::class, 'datapetakerawanan'])->name('petakerawanan');
    Route::get('/tambahpetakerawanan', [GuruController::class, 'tambahpetakerawanan'])->name('tambahpetakerawanan');
    Route::post('/insertkerawanan', [GuruController::class, 'storekerawanan'])->name('insertkerawanan');
    Route::get('/jeniskerawanan/{id}', [GuruController::class, 'jeniskerawanan'])->name('jeniskerawanan');
    Route::get('/deletekerawanan/{id}', [GuruController::class, 'deletekerawanan'])->name('deletekerawanan');
    ////ENDDGURU

    /////PETAKERAWANAN/WALAS//////
    Route::get('/petakerawanan', [WaliKelasController::class, 'datakerawananwalas'])->name('petakerawanan');
    Route::get('/tambahpetakerawanan', [WaliKelasController::class, 'tambahpetakerawanan'])->name('tambahpetakerawanan');
    Route::post('/insertkerawanan', [WaliKelasController::class, 'storekerawanan'])->name('insertkerawanan');
    Route::get('/jeniskerawanan/{id}', [WaliKelasController::class, 'jeniskerawanan'])->name('jeniskerawanan');
    Route::get('/deletekerawanan/{id}', [WaliKelasController::class, 'deletekerawanan'])->name('deletekerawanan');
    // Route::post('/postlogin', 'LoginController@postlogin')->name('postlogin');
    // Route::get('/siswa',[SiswaController::class, 'siswa'])->name('siswa');