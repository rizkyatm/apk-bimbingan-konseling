<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Konseling_bk;
use App\Models\Layanan_bk;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class SiswaController extends Controller
{
    public function profilsiswa(){
        $user = User::find(Auth::id()); // Ambil data pengguna yang sedang login
        $user->load('siswa'); // Muat relasi 'siswa' dari pengguna
        return view('siswa.profilsiswa', compact('user'));
    }

    public function updateprofilsiswa(Request $request, $id){
        $data = Siswa::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya
    
        // Update data siswa
        $data->namasiswa = $request->input('namasiswa');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotosiswa/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotosiswa/', $fotoName);
    
            // Update foto siswa
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; // Get the associated User model
        if ($user) {
            $user->name = $request->input('namasiswa');
            $user->nisn_nip = $request->input('nisn');
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            } 
            $user->save();
        }
    
        return redirect()->route('profilsiswa');
    }



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
    
        return view('siswa.jadwal', compact('jadwalbk', 'namasiswa','layanan','user'));
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
        $user = User::with('siswa')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->siswa->id; // nyari id guru dari siapa yang loginnya
        // $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kelas
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('siswa_id', $id)
        ->whereIn('status', ['SELESAI'])//Hanya memanggil data yg statusnya berisi value 'SELESAI'
        ->latest('created_at')
        ->get();


        return view('siswa.histori', compact('jadwalbk','user'));
    }
}
