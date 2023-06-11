<?php

namespace App\Http\Controllers;

use App\Models\Guru;
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



    public function jadwal()
    {
        $user = User::with('siswa')->find(Auth::id());
        $namasiswa = $user->siswa->id;
    
        // Mendapatkan guru yang mengajar siswa yang sedang login
        $guru = $user->siswa->kelas->guru;
    
        $layanan = Layanan_bk::all();
    
        // Mendapatkan daftar siswa yang diajar oleh guru yang sama dengan siswa yang sedang login
        $siswa = Siswa::whereHas('kelas', function ($query) use ($guru) {
            $query->where('guru_id', $guru->id);
        })->get();
    
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')
            ->where('siswa_id', $user->siswa->id)
            ->whereIn('status', ['MENUNGGU..', 'DITERIMA', 'DIUNDUR'])
            ->latest('created_at')
            ->get();
    
        return view('siswa.jadwal', compact('jadwalbk', 'namasiswa', 'layanan', 'user', 'siswa'));
    }
    
    

    public function siswatambahJadwal(Request $request)
    {
        if ($request->has('manysiswa')) {
            $siswa_ids = (array) $request->input('manysiswa');
        } else {
            $siswa_ids = Siswa::where('user_id', Auth::id())->pluck('id')->toArray();
        }

        foreach ($siswa_ids as $siswa_id) {
            $siswa = Siswa::with('kelas.guru', 'kelas.walikelas')->find($siswa_id);
            $guru_id = $siswa->kelas->guru->id;
            $walas_id = $siswa->kelas->walikelas->id;
    
            $input = $request->only('layanan_id', 'tanggal', 'waktu', 'tempat');
            $waktu = $input['tanggal'] . ' ' . $input['waktu'];
    
            $jadwalbk = new Konseling_bk();
            $jadwalbk->siswa_id = $siswa_id;
            $jadwalbk->layanan_id = $input['layanan_id'];
            $jadwalbk->guru_id = $guru_id;
            $jadwalbk->walas_id = $walas_id;
            $jadwalbk->tempat = $input['tempat'];
            $jadwalbk->waktu = $waktu;
            $jadwalbk->status = 'MENUNGGU..';
            $jadwalbk->save();
        }
    
        return redirect()->route('jadwal')->with('success', 'Data jadwal berhasil ditambahkan.');
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
