<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Konseling_bk;
use App\Models\User;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class WaliKelasController extends Controller
{
    ////////////////////////////////profil walikelas start////////////////////////////////
    public function profilwalas(){
        $user = User::find(Auth::id()); // Ambil data pengguna yang sedang login
        $user->load('walikelas'); // Muat relasi 'siswa' dari pengguna
        $id = $user->walikelas->id; // nyari id wali kelas dari siapa yang loginnya
        $kelas = Kelas::where('walikelas_id', $id)->get();
        return view('walas.profilwalas', compact('user', 'kelas'));
    }
    
    public function updateprofilwalikelas(Request $request, $id){
        $data = WaliKelas::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya
    
        // Update data guru
        $data->namagurukelas = $request->input('namagurukelas');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            if ($previousFoto) {
                $filePath = public_path('fotowalikelas/' . $previousFoto);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
            }
    
            $foto = $request->file('foto');
            $fotoName = $foto->getClientOriginalName();
            $foto->move('fotowalikelas/', $fotoName);
    
            // Update foto guru
            $data->foto = $fotoName;
            $data->save();
        }
    
        $user = $data->user; // Get the associated User model
        if ($user) {
            $user->name = $request->input('namagurukelas');
            $user->nisn_nip = $request->input('nip');
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            } 
            $user->save();
        }  
        return redirect()->route('profilwalas');
    }  
    ////////////////////////////////profil walikelas end//////////////////////////////////

    ////////////////////////////////jadwal panggilan start////////////////////////////////
    public function jadwalkonseling(){
        $user = User::with('walikelas')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->walikelas->id; // nyari id wali kelas dari siapa yang loginnya
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('walas_id', $id)
        ->whereIn('status', ['MENUNGGU..', 'DITERIMA', 'DIUNDUR'])//Hanya memanggil data yg statusnya berisi value 'MENUNGGU..', 'DITERIMA', 'DIUNDUR'
        ->latest('created_at')
        ->get();


        return view('walas.jadwalkonseling', compact('jadwalbk','user'));
    }

    public function imputhasilbelajar(Request $request, $id){
        // Proses penyimpanan data jadwal yang di selesaikan
        $jadwal = Konseling_bk::find($id);
        $jadwal->hasil_konseling = $request->hasil_konseling;
        $jadwal->status = 'SELESAI';
        $jadwal->save();
    
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back();
    }
    ////////////////////////////////jadwal panggilan end//////////////////////////////////

    ////////////////////////////////////archives start////////////////////////////////////
    public function hasilkonseling(){
        $user = User::with('walikelas')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->walikelas->id; // nyari id wali kelas dari siapa yang loginnya
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('walas_id', $id)
        ->whereIn('status', ['SELESAI'])//Hanya memanggil data yg statusnya berisi value 'SELESAI'
        ->latest('created_at')
        ->get();


        return view('walas.hasilkonseling', compact('jadwalbk','user'));
    }
    ////////////////////////////////////archives end//////////////////////////////////////
   
}
