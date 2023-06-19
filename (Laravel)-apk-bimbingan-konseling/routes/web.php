<?php

use App\Http\Controllers\LandingpageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FakerController;
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
        Route::get('/Admin/TampilkanGuru/{id}', [AdminController::class, 'TampilkanGuru'])->middleware('checkRole:admin'); //UNTUK MENAMPILKAN FORM BESERTA VALUENYA SESUAI ID
        Route::post('/Admin/UpdateGuru/{id}', [AdminController::class, 'UpdateGuru'])->middleware('checkRole:admin'); //UNTUK MENGUPDATE DATA GURU KEDALAM DATABASE SESUAI ID (BACKEND)
        Route::get('/Admin/DeleteGuru/{id}', [AdminController::class, 'DeleteGuru'])->middleware('checkRole:admin');  //UNTUK HAPUS DATA GURU KEDALAM DATABASE SESUAI ID (BACKEND)
    
        // siswa
        Route::get('/Admin/Siswa', [AdminController::class, 'Siswa'])->name('Siswa')->middleware('checkRole:admin'); //MENAMPILKAN TABLE SISWA
        Route::get('/Admin/TambahSiswa', [AdminController::class, 'tambahdatasiswa'])->middleware('checkRole:admin'); //MENAMPILKAN FORM UNTUK MENAMBAHKAN DATA SISWA
        Route::post('/Admin/insertSiswa', [AdminController::class, 'insertSiswa'])->middleware('checkRole:admin'); //UNTUK MEMASUKAN DATA SISWA KEDALAM DATABASE (BACKEND)
        Route::get('/Admin/TampilkanSiswa/{id}', [AdminController::class, 'TampilkanSiswa'])->middleware('checkRole:admin'); //UNTUK MENAMPILKAN FORM BESERTA VALUENYA SESUAI ID
        Route::post('/Admin/UpdateSiswa/{id}', [AdminController::class, 'UpdateSiswa'])->middleware('checkRole:admin'); //UNTUK MENGUPDATE DATA SISWA KEDALAM DATABASE SESUAI ID (BACKEND)
        Route::get('/Admin/DeleteSiswa/{id}', [AdminController::class, 'DeleteSiswa'])->middleware('checkRole:admin'); //UNTUK HAPUS DATA SISWA KEDALAM DATABASE SESUAI ID (BACKEND)
    
        // kelas
        Route::get('/Admin/kelas', [AdminController::class, 'kelas'])->name('kelas')->middleware('checkRole:admin'); //MENAMPILKAN TABLE KELAS
        Route::get('/Admin/TambahKelas', [AdminController::class, 'tambahkelas'])->middleware('checkRole:admin'); //MENAMPILKAN FORM UNTUK MENAMBAHKAN DATA KELAS
        Route::post('/Admin/insertKelas', [AdminController::class, 'insertKelas'])->middleware('checkRole:admin'); //UNTUK MEMASUKAN DATA KELAS KEDALAM DATABASE (BACKEND)
        Route::get('/Admin/DeleteKelas/{id}', [AdminController::class, 'DeleteKelas'])->middleware('checkRole:admin'); //UNTUK HAPUS DATA KELAS KEDALAM DATABASE SESUAI ID (BACKEND)

        // Wali Kelas
        Route::get('/Admin/WaliKelas', [AdminController::class, 'WaliKelas'])->name('WaliKelas')->middleware('checkRole:admin'); //MENAMPILKAN TABLE WALI KELAS
        Route::get('/Admin/TambahWaliKelas', [AdminController::class, 'TambahWaliKelas'])->middleware('checkRole:admin'); //MENAMPILKAN FORM UNTUK MENAMBAHKAN DATA WALI KELAS
        Route::post('/Admin/InsertWaliKelas', [AdminController::class, 'InsertWaliKelas'])->middleware('checkRole:admin'); //UNTUK MEMASUKAN DATA WALI KELAS KEDALAM DATABASE (BACKEND)
        Route::get('/Admin/TampilkanWaliKelas/{id}', [AdminController::class, 'TampilkanWaliKelas'])->middleware('checkRole:admin'); //UNTUK MENAMPILKAN FORM BESERTA VALUENYA SESUAI ID
        Route::post('/Admin/UpdateWaliKelas/{id}', [AdminController::class, 'UpdateWaliKelas'])->middleware('checkRole:admin'); //UNTUK MENGUPDATE DATA WALI KELAS KEDALAM DATABASE SESUAI ID (BACKEND)
        Route::get('/Admin//DeleteWaliKelas/{id}', [AdminController::class, 'DeleteWaliKelas'])->middleware('checkRole:admin'); //UNTUK HAPUS DATA WALI KELAS KEDALAM DATABASE SESUAI ID (BACKEND)

        // Data Kerawanan
        Route::get('/Admin/DataKerawan', [AdminController::class, 'petakerawanan'])->name('petakerawanan')->middleware('checkRole:admin'); //MENAMPILKAN TABLE DATA KERAWANAN
        Route::get('/Admin/TambahDataKerawan', [AdminController::class, 'tambahpelanggaran'])->middleware('checkRole:admin'); //MENAMPILKAN FORM UNTUK MENAMBAHKAN DATA KERAWANAN
        Route::post('/Admin/InsertDataKerawanan', [AdminController::class, 'insertpetaadmin'])->middleware('checkRole:admin'); //UNTUK MEMASUKAN DATA KERAWANAN KEDALAM DATABASE (BACKEND)
        Route::get('/Admin/DeleteDataKerawana/{id}', [AdminController::class, 'deletepetakerawanan'])->middleware('checkRole:admin'); //UNTUK HAPUS DATA KERAWANAN KELAS KEDALAM DATABASE SESUAI ID (BACKEND)

    //////////////////////////////////////////akun guru start///////////////////////////////////////////
        //profil
        Route::get('/Guru/Profile', [GuruController::class, 'Profile'])->name('Profile')->middleware('checkRole:guru');
        Route::post('/Guru/UpdateProfile/{id}', [GuruController::class, 'UpdateProfile'])->middleware('checkRole:guru');
        
        //buat jadwal
        Route::get('/Guru/Jadwal', [GuruController::class, 'Jadwal'])->middleware('checkRole:guru');
        Route::post('/Guru/tambahjadwal', [GuruController::class, 'TambahJadwal'])->middleware('checkRole:guru');
        Route::post('/getdatasiswa', [GuruController::class, 'getSiswaByKelas']);
        Route::post('/Guru/MundurkanJadwal/{id}', [GuruController::class, 'MundurkanJadwal'])->middleware('checkRole:guru');
        Route::post('/Guru/TerimaJadwal/{id}', [GuruController::class, 'TerimaJadwal'])->middleware('checkRole:guru');
        Route::post('/Guru/SelesaikanJadwal/{id}', [GuruController::class, 'SelesaikanJadwal'])->middleware('checkRole:guru');

        //Archives
        Route::get('/Guru/Archives', [GuruController::class, 'Archives'])->middleware('checkRole:guru');
        
        //Peta Kerawanan 
        Route::get('/Guru/Kelas', [GuruController::class, 'Kelas'])->middleware('checkRole:guru');
        Route::get('/Guru/Siswa/{kelasId}', [GuruController::class, 'siswa'])->middleware('checkRole:guru');
        Route::get('/Kerawanan/{id}', [GuruController::class, 'kerawanan'])->middleware('checkRole:guru');
        Route::post('/tambahkerawan/{id}', [GuruController::class, 'tambahDataPetakerawanan'])->middleware('checkRole:guru');

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
       
        // Peta Kerawanan
        Route::get('/petakerawananwalas', [WaliKelasController::class, 'datakerawananwalas'])->name('petakerawananwalas');
        Route::get('/Kerawanansiswa/{id}', [WaliKelasController::class, 'Kerawanansiswa'])->name('petakerawananwalas');
        Route::post('/tambahKerawanansiswa/{id}', [WaliKelasController::class, 'tambahPetakerawanansiswa'])->name('petakerawananwalas');

        Route::get('/exportpetakerawanansiswa', [WaliKelasController::class, 'exportpetakerawanansiswa'])->name('exportpetakerawanansiswa');

   //////////////////////////////////////////akun wali kelas end////////////////////////////////////////////
});

     /////////////////////////////////////ExportExcel///////////////////////////////////////////
     Route::get('/exportguru', [AdminController::class, 'exportguru'])->name('exportguru');
     Route::get('/exportwalas', [AdminController::class, 'exportwalas'])->name('exportwalas');
     Route::get('/exportkelas', [AdminController::class, 'exportkelas'])->name('exportkelas');
     Route::get('/exportsiswa', [AdminController::class, 'exportsiswa'])->name('exportsiswa');

    /////PETAKERAWANAN/WALAS//////
   

    // FAKER
    Route::get('/RunFakeData', [FakerController::class, 'RunFakeData']); //MEMBUAT DATA PALSU (FAKER)
