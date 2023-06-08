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
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function guru(){
        $user = User::find(Auth::id()); // Ambil data pengguna yang sedang login
        $user->load('guru'); // Muat relasi 'guru' dari pengguna
        return view('guru.profilGuru', compact('user'));
    }
    public function akunSiswa(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kelas

        return view('guru.akunSiswa', compact('kelas'));
    }

    public function menampikanmurid($kelasId){
        $kelasguru = Kelas::find($kelasId);
        $siswa = Siswa::where('kelas_id', $kelasId)->get();
        return view('guru.siswa', compact('siswa','kelasguru'));
    }


    public function updateprofilguru(Request $request, $id)
    {
        $data = Guru::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya
    
        // Update data guru
        $data->namaguru = $request->input('namaguru');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotoguru/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotoguru/', $fotoName);
    
            // Update foto guru
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; // Get the associated User model
        if ($user) {
            $user->name = $request->input('namaguru');
            $user->nisn_nip = $request->input('nip');
            $user->password = Hash::make($request->input('password'));
            $user->save();
        }
    
        return redirect()->route('guru');
    }

    public function buatJadwal(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kela
        $layanan = Layanan_bk::whereIn('id', [1, 2])->get(); //memanggil jenis layanan bk


        return view('guru.buatJadwal', compact('kelas','layanan'));
    }

    public function getSiswaByKelas(Request $request)
    {
        $kelasId = $request->input('kelasId');
    
        // Query untuk mendapatkan siswa berdasarkan kelasId
        $siswaList = Siswa::where('kelas_id', $kelasId)->get();
    
        return response()->json($siswaList);
    }

    public function tambahjadwal(Request $request){
        // dd($request->all());
        $request->validate([
            'kelas_id' => 'required',
            'siswa_id' => 'required',
            'layanan_id' => 'required',
            'tanggal' => 'required',
            'wkatu' => 'required',
            'tempat' => 'required'
        ]);

        // Mendapatkan guru_id dan walas_id dari siswa terkait
        $siswa = Siswa::with('kelas')->find($request->siswa_id);
        $guru_id = $siswa->kelas->guru->id;
        $walas_id = $siswa->kelas->walikelas->id;

        // Menggabungkan waktu dan tanggal menjadi satu field datetime
        $tanggalWaktu = $request->tanggal . ' ' . $request->wkatu;

        // Menambahkan data jadwal baru
        $jadwal = new Konseling_bk();
        $jadwal->guru_id = $guru_id;
        $jadwal->walas_id = $walas_id;
        $jadwal->siswa_id = $request->siswa_id;
        $jadwal->layanan_id = $request->layanan_id;
        $jadwal->wkatu = $tanggalWaktu;
        $jadwal->tempat = $request->tempat;
        $jadwal->status = "DITERIMA";
        $jadwal->save();

            // Mengembalikan respons dengan informasi debug
    // return response()->json($jadwal);

        return redirect()->back()->with('success', 'Data jadwal berhasil ditambahkan.');
    }


    public function kelasSiswa(){
        return view('guru.kelasSiswa');
    }
}
