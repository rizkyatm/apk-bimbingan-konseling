<?php

namespace App\Http\Controllers;

use App\Exports\PetaKerawananExport;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\WaliKelas;
use App\Models\Konseling_bk;
use Illuminate\Http\Request;
use App\Models\PetaKerawanan;
use App\Models\JenisPetaKerawanan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;


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
            // if ($previousFoto) {
            //     $filePath = public_path('fotowalikelas/' . $previousFoto);
            //     if (File::exists($filePath)) {
            //         File::delete($filePath);
            //     }
            // }
    
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
        ->whereIn('layanan_id', [2, 3, 4]) // Menambahkan batasan pada layanan_id
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
        
        $jadwalbk = Konseling_bk::with('guru', 'siswa', 'layanan_bk', 'wali_kelas')
        ->where('walas_id', $id)
        ->whereIn('status', ['SELESAI'])
        ->whereIn('layanan_id', [2, 3, 4]) // Menambahkan batasan pada layanan_id
        ->latest('created_at')
        ->get();


        return view('walas.hasilkonseling', compact('jadwalbk','user'));
    }
    ////////////////////////////////////archives end//////////////////////////////////////
   /////////////////////////////////////kerawanan walas/////////////////////////////////
//    public function datakerawananwalas(){
//        $user = User::with('walikelas')->find(Auth::id()); // Mengambil data user yang sedang login dan eager load relasi walikelas
       
//        $walikelas = $user->walikelas;// Mengambil daftar ID kelas terkait dengan walikelas
//        $kelasIds = $walikelas->kelas->siswa->pluck('kelas_id')->toArray(); // Mengambil daftar ID kelas terkait dengan walikelas
       
//        $siswa = Siswa::whereHas('kelas', function ($query) use ($kelasIds) {
//            $query->whereIn('id', $kelasIds);
//        })->get(); // Mengambil siswa-siswa yang memiliki kelas dengan ID yang terkait dengan walikelas
       
//        return view('walas.petakerawananwalas', compact('user','siswa'));
//    }

        public function datakerawananwalas(){
            $user = User::with('walikelas')->find(Auth::id()); // Mengambil data user yang sedang login dan eager load relasi walikelas

            $walikelasId = $user->walikelas->id; // Mengambil ID walikelas terkait dengan user

            $siswa = Siswa::whereHas('kelas', function ($query) use ($walikelasId) {
                $query->where('walikelas_id', $walikelasId);
            })->get(); // Mengambil siswa-siswa yang memiliki kelas dengan ID walikelas yang terkait

            return view('walas.petakerawananwalas', compact('user', 'siswa'));
        }

        public function Kerawanansiswa($id){
            $siswa = Siswa::find($id);
            $user = User::with('guru')->find(Auth::id()); // nyari tabel user yg login
            $petakerawanan = PetaKerawanan::where('siswa_id', $siswa->id)->get();
                
            return view('walas.tambahpetakerawanan', compact('user', 'siswa', 'petakerawanan'));
        }

        public function tambahPetakerawanansiswa(Request $request, $id)
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
                $petakerawanan->waliKelas_id = $waliKelas->id;
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

        public function exportpetakerawanansiswa($id)
        {
            return Excel::download(new PetaKerawananExport($id), 'Petakerawana.xlsx');
        }
   
   /////////////////////////////////////end/////////////////////////////////
}
