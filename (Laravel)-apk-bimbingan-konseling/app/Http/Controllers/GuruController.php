<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Guru;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Layanan_bk;
use App\Models\Konseling_bk;
use App\Models\PetaKerawanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    ////////////////////////////////profil guru start////////////////////////////////
    public function Profile(){
        $user = User::find(Auth::id()); // Ambil data pengguna yang sedang login
        $user->load('guru'); // Muat relasi 'guru' dari penggunasis
        return view('guru.profilGuru', compact('user'));
    }

    public function UpdateProfile(Request $request, $id){
        $data = Guru::find($id);
        $previousFoto = $data->foto; // Simpan nama foto sebelumnya
    
        // Update data guru
        $data->namaguru = $request->input('namaguru');
        $data->jeniskelamin = $request->input('jeniskelamin');
        $data->tempatlahir = $request->input('tempatlahir');
        $data->tanggallahir = $request->input('tanggallahir');
        $data->save();
    
        if ($request->hasFile('foto')) {
            // if ($previousFoto) {
            //     $filePath = public_path('fotoguru/' . $previousFoto);
            //     if (File::exists($filePath)) {
            //         File::delete($filePath);
            //     }
            // }
    
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
            if ($request->input('password')) {
                $user->password = Hash::make($request->input('password'));
            } 
            $user->save();
        }
    
        return redirect()->route('Profile');
    }
    ////////////////////////////////profil guru end//////////////////////////////////

    ////////////////////////////////kelas siswa start////////////////////////////////
    public function Kelas(){
        $user = User::with('guru')->find(Auth::id()); // nyari id di tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kelas
        
        return view('guru.Kelas', compact('kelas','user'));
    }

    public function siswa($kelasId){
        $user = User::find(Auth::id()); // Ambil data pengguna yang sedang login
        $user->load('guru');

        $kelasguru = Kelas::find($kelasId); //membawa data kelas sesuai id
        $siswa = Siswa::where('kelas_id', $kelasId)->get();
        return view('guru.siswa', compact('siswa','kelasguru','user'));
    }
    ////////////////////////////////kelas siswa end//////////////////////////////////


    ////////////////////////////////profil kelas siswa start////////////////////////////////
    public function Jadwal(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang ada di kelas
        $siswa = Siswa::whereIn('kelas_id', $kelas->pluck('id'))->get(); // Mengambil siswa yang diajar oleh guru
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')
        ->where('guru_id', $id)
        ->whereIn('status', ['MENUNGGU..', 'DITERIMA', 'DIUNDUR'])
        ->latest('created_at')
        ->get();
        //memnaggil jadwal konseling beserta relasinya
        $layanan = Layanan_bk::whereIn('id', [1, 2, 4])->get(); //memanggil jenis layanan bk

        return view('guru.Jadwal', compact('kelas','layanan', 'jadwalbk','user','siswa'));
    }

    public function getSiswaByKelas(Request $request){
        $kelasId = $request->input('kelasId');

        // Query untuk mendapatkan siswa berdasarkan kelasId
        $siswaList = Siswa::where('kelas_id', $kelasId)->get(); //mengambil data siswa sesuai request id kelas
    
        return response()->json($siswaList);
    }

    public function TambahJadwal(Request $request){
        // Menentukan siswa_id yang akan digunakan
        if ($request->has('manysiswa_id')) {
            $siswa_ids = (array) $request->input('manysiswa_id');
        } else {
            $siswa_ids = [$request->input('siswa_id')];
        }
        
        // Menambahkan data jadwal baru
        foreach ($siswa_ids as $siswa_id) {
            // Mendapatkan guru_id dan walas_id dari kelas terkait
            $siswa = Siswa::with('kelas')->find($siswa_id);
            $guru_id = $siswa->kelas->guru->id;
            $walas_id = $siswa->kelas->walikelas->id;
            // Menggabungkan tanggal dan waktu menjadi satu field datetime
            $tanggalWaktu = $request->tanggal . ' ' . $request->waktu;
        
            $jadwal = new Konseling_bk();
            $jadwal->guru_id = $guru_id;
            $jadwal->walas_id = $walas_id;
            $jadwal->siswa_id = $siswa_id;
            $jadwal->layanan_id = $request->layanan_id;
            $jadwal->waktu = $tanggalWaktu;
            $jadwal->tempat = $request->tempat;
            $jadwal->status = "DITERIMA";
            $jadwal->save();
        }
    
        return redirect()->back()->with('success', 'Data jadwal berhasil ditambahkan.');
    }    
    
    public function TerimaJadwal(Request $request, $id){
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

    public function MundurkanJadwal(Request $request, $id){
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


    public function SelesaikanJadwal(Request $request, $id){
        // Proses penyimpanan data jadwal yang di selesaikan
        $jadwal = Konseling_bk::find($id);
        $jadwal->hasil_konseling = $request->hasil_konseling;
        $jadwal->status = 'SELESAI';
        $jadwal->save();
    
        // Redirect atau melakukan tindakan lain sesuai kebutuhan
        return redirect()->back()->with('success', 'Jadwal berhasil diundur.');
    }
    ////////////////////////////////profil kelas siswa end//////////////////////////////////


    ///////////////////////////////////////Archives Start///////////////////////////////////////
    public function Archives(){
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $id = $user->guru->id; // nyari id guru dari siapa yang loginnya
        $kelas = Kelas::where('guru_id', $id)->get(); // cari kelas sesuai dari tabel yang adai di kelas
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')->where('guru_id', $id)
        ->whereIn('status', ['SELESAI'])//Hanya memanggil data yg statusnya berisi value 'SELESAI'
        ->latest('created_at')
        ->get();

        return view('guru.Archives', compact('kelas', 'jadwalbk','user'));
    }
    ///////////////////////////////////////Archives End///////////////////////////////////////

    
    ////////////////////////////////petakerawanan  Start//////////////////////////////////

    public function Kerawanan($id){
        $siswa = Siswa::find($id);
        $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
        $petakerawanan = PetaKerawanan::where('siswa_id', $siswa->id)->get();
            
        return view('guru.petakerawanan', compact('user', 'siswa', 'petakerawanan'));
    }

    public function tambahDataPetakerawanan(Request $request, $id)
    {
        // Ambil data siswa berdasarkan ID yang diberikan
        $siswa = Siswa::findOrFail($id);
    
        // Ambil data kelas dan wali kelas dari objek siswa
        $kelas = $siswa->kelas;
        $waliKelas = $kelas->walikelas;
    
        // Buat array untuk menyimpan nilai checkbox yang dicentang
        $checkboxValues = [];
        for ($i = 1; $i <= 20; $i++) {
            if ($request->has($i)) {
                $checkboxValues[$i] = '✓';
            } else {
                $checkboxValues[$i] = null;
            }
        }
    
        // Temukan atau buat data pada tabel "petakerawanan" berdasarkan siswa_id
        $petakerawanan = Petakerawanan::where('siswa_id', $siswa->id)->first();
        if ($petakerawanan) {
            // Update data petakerawanan jika sudah ada
            $petakerawanan->walas_id = $waliKelas->id;
            for ($i = 1; $i <= 20; $i++) {
                $petakerawanan->{"kolom" . $i} = $checkboxValues[$i];
            }
            $petakerawanan->save();
    
            $message = "Data berhasil diperbarui!";
        } else {
            // Buat data petakerawanan baru jika belum ada
            $petakerawanan = new Petakerawanan([
                'siswa_id' => $siswa->id,
                'waliKelas_id' => $waliKelas->id,
            ]);
            for ($i = 1; $i <= 20; $i++) {
                $petakerawanan->{"kolom" . $i} = $checkboxValues[$i];
            }
            $petakerawanan->save();
    
            $message = "Data berhasil ditambahkan!";
        }
    
        // Menghapus data petakerawanan jika tidak ada inputan dari checkbox
        if (empty(array_filter($checkboxValues))) {
            $petakerawanan->delete();
            $message = "Siswa Tidak Memilik Data Kerawanan!";
        }
    
        return redirect()->back()->with('success', $message);
    }
    
    
    
    
    
    


    ////////////////////////////////petakerawanan  End////////////////////////////////////




}
