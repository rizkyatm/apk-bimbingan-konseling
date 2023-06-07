<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
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
            $foto->move('fotosiswa/', $fotoName);
    
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
        return view('guru.buatJadwal');
    }
    public function kelasSiswa(){
        return view('guru.kelasSiswa');
    }
}
