<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Konseling_bk;
use App\Models\Layanan_bk;
use App\Models\Siswa;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    ////////////////////////////////profil guru start////////////////////////////////
    public function guru(){
        $user = User::find(Auth::id()); // Ambil data pengguna yang sedang login
        $user->load('guru'); // Muat relasi 'guru' dari pengguna
        return view('guru.profilGuru', compact('user'));
    }

    public function updateprofilguru(Request $request, $id){
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
    ////////////////////////////////profil guru end//////////////////////////////////

    ////////////////////////////////kelas siswa start////////////////////////////////
    public function akunSiswa(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kelas
        
        return view('guru.akunSiswa', compact('kelas'));
    }

    public function menampikanmurid($kelasId){
        $kelasguru = Kelas::find($kelasId); //membawa data kelas sesuai id
        $siswa = Siswa::where('kelas_id', $kelasId)->get();
        return view('guru.siswa', compact('siswa','kelasguru'));
    }
    ////////////////////////////////kelas siswa end//////////////////////////////////


    ////////////////////////////////profil kelas siswa start////////////////////////////////
    public function buatJadwal(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kelas
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')
        ->where('guru_id', $id)
        ->whereIn('status', ['MENUNGGU..', 'DITERIMA', 'DIUNDUR'])
        ->latest('created_at')
        ->get();
        //memnaggil jadwal konseling beserta relasinya
        $layanan = Layanan_bk::whereIn('id', [1, 2, 4])->get(); //memanggil jenis layanan bk

        return view('guru.buatJadwal', compact('kelas','layanan', 'jadwalbk'));
    }

    public function getSiswaByKelas(Request $request){
        $kelasId = $request->input('kelasId');

        // Query untuk mendapatkan siswa berdasarkan kelasId
        $siswaList = Siswa::where('kelas_id', $kelasId)->get(); //mengambil data siswa sesuai request id kelas
    
        return response()->json($siswaList);
    }

    public function tambahjadwal(Request $request){
        // dd($request->all());
        $request->validate([
            'kelas_id' => 'required',
            'siswa_id' => 'required',
            'layanan_id' => 'required',
            'tanggal' => 'required',
            'waktu' => 'required',
            'tempat' => 'required'
        ]);

        // Mendapatkan guru_id dan walas_id dari siswa terkait
        $siswa = Siswa::with('kelas')->find($request->siswa_id);
        $guru_id = $siswa->kelas->guru->id;
        $walas_id = $siswa->kelas->walikelas->id;


        // Menggabungkan waktu dan tanggal menjadi satu field datetime
        $tanggalWaktu = $request->tanggal . ' ' . $request->waktu;

        // Menambahkan data jadwal baru
        $jadwal = new Konseling_bk();
        $jadwal->guru_id = $guru_id;
        $jadwal->walas_id = $walas_id;
        $jadwal->siswa_id = $request->siswa_id;
        $jadwal->layanan_id = $request->layanan_id;
        $jadwal->waktu = $tanggalWaktu;
        $jadwal->tempat = $request->tempat;
        $jadwal->status = "DITERIMA";
        $jadwal->save();  

        return redirect()->back()->with('success', 'Data jadwal berhasil ditambahkan.');
    }

    public function terimajadwal(Request $request, $id){
        $jadwal = Konseling_bk::find($id);
        
        $nilaiBaru = $request->input('tempat');
        $nilaiLama = $jadwal->tempat;
        
        if ($nilaiBaru !== $nilaiLama) {
            // Nilai baru berbeda dengan nilai lama, tambahkan "(DI GANTI)"
            $hasil = $nilaiBaru . ' (Di ubah oleh guru)';
        } else {
            // Nilai baru sama dengan nilai lama, tidak perlu menambahkan "(DI GANTI)"
            $hasil = $nilaiBaru;
        }
        
        $jadwal->tempat = $hasil;
        $jadwal->status = 'DITERIMA';
        $jadwal->save();
        
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back()->with('success', 'Jadwal berhasil diundur.');
        
        
    }
    

    public function mundurkanJadwal(Request $request, $id){
    
        // Menggabungkan tanggal dan jam menjadi tipe data datetime
        $waktu = Carbon::parse($request->tanggal . ' ' . $request->jam);
    
        // Proses penyimpanan data jadwal yang diundur
        $jadwal = Konseling_bk::find($id);
        $jadwal->waktu = $waktu;
        $jadwal->status = 'DIUNDUR';
        $jadwal->save();
    
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back()->with('success', 'Jadwal berhasil diundur.');
    }


    public function selesaikanjadwal(Request $request, $id){
        // Proses penyimpanan data jadwal yang di selesaikan
        $jadwal = Konseling_bk::find($id);
        $jadwal->hasil_konseling = $request->hasil_konseling;
        $jadwal->status = 'SELESAI';
        $jadwal->save();
    
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back()->with('success', 'Jadwal berhasil diundur.');
    }
    ////////////////////////////////profil kelas siswa end//////////////////////////////////


    ////////////////////////////////History Start////////////////////////////////
    public function history(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kelas
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('guru_id', $id)
        ->whereIn('status', ['SELESAI'])//Hanya memanggil data yg statusnya berisi value 'SELESAI'
        ->latest('created_at')
        ->get();


        return view('guru.history', compact('kelas', 'jadwalbk'));
    }
    ////////////////////////////////History End//////////////////////////////////

}
