<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Konseling_bk;
use App\Models\Layanan_bk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function profilsiswa(){
        return view('siswa.profilsiswa');
    }
    // public function jadwal(){
    //     return view('siswa.jadwal');
    // }

    public function jadwal(){
        $user = User::with('siswa')->find(Auth::id()); // Mencari data user yang sedang login
        $namasiswa = $user->siswa->namasiswa; // Mengambil nama siswa dari user yang sedang login
        $id = $user->siswa->id; // Mengambil ID siswa dari user yang sedang login

        $layanan = Layanan_bk::all();
    
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')
            ->where('siswa_id', $id)
            ->whereIn('status', ['MENUNGGU..', 'DITERIMA', 'DIUNDUR'])
            ->latest('created_at')
            ->get();
    
        return view('siswa.jadwal', compact('jadwalbk', 'namasiswa','layanan'));
    }

    public function siswatambahJadwal(Request $request){
        $user = User::with('siswa.kelas.guru', 'siswa.kelas.walikelas')->find(Auth::id()); // Mencari data user yang sedang login
        $siswa_id = $user->siswa->id; // Mengambil ID siswa dari user yang sedang login
        $guru_id = $user->siswa->kelas->guru->id; // Mengambil ID guru dari kelas siswa
        $walas_id = $user->siswa->kelas->walikelas->id; // Mengambil ID wali kelas dari kelas siswa
        
        $input = $request->only('layanan_id', 'tanggal', 'waktu', 'tempat');

        // Menggabungkan tanggal dan waktu menjadi format datetime
        $waktu = $input['tanggal'] . ' ' . $input['waktu'];

        // Menyimpan data ke tabel Konseling_bk
        $jadwalbk = new Konseling_bk();
        $jadwalbk->siswa_id = $siswa_id;
        $jadwalbk->layanan_id = $input['layanan_id'];
        $jadwalbk->guru_id = $guru_id;
        $jadwalbk->walas_id = $walas_id;
        $jadwalbk->tempat = $input['tempat'];
        $jadwalbk->waktu = $waktu;
        $jadwalbk->status = 'MENUNGGU..';
        $jadwalbk->save();

        // Redirect atau melakukan operasi lainnya

        // Contoh redirect ke halaman jadwal setelah berhasil menambahkan
        return redirect()->route('jadwal');
    }

    public function histori(){
        return view('siswa.histori');
    }
}
