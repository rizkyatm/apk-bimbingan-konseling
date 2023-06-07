<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function profilsiswa(){
        return view('siswa.profilsiswa');
    }
    public function jadwal(){
        return view('siswa.jadwal');
    }
    public function histori(){
        return view('siswa.histori');
    }
}
