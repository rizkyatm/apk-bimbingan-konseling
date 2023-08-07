<?php

namespace App\Http\Controllers\API; // Tentukan namespace yang tepat untuk kelas ini
use App\Http\Controllers\Controller;
use App\Models\Konseling_bk;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class storeApiController extends Controller
{
    public function getDataAkun(Request $request)
    {
        $siswa = Siswa::with('kelas', 'user')->where('id', $request->id)->first();
    
        $jadwal = [
                'siswa_id' => $siswa->id,
                'user_id' => $siswa->user_id,
                'nama_siswa' => $siswa->namasiswa,
                'kelas_id' => $siswa->kelas_id,
                'walikelas_id' => $siswa->kelas->walikelas_id,
                'walikelas' => $siswa->kelas->walikelas->namagurukelas,
                'guru_id' => $siswa->kelas->guru_id,
                'guru' => $siswa->kelas->guru->namaguru,
        ];
    
        return response()->json(['message' => 'Success', 'data' => $jadwal]);
    }
    
    public function storeJadwal(Request $request)
    {
        $murid = User::with('murid')->where('id', $request->id)->first();
    
        $jadwalbaru = Konseling_bk::create([
            'layanan_id' => $request->input('layanan_id'),
            'siswa_id' => $request->input('siswa_id'),
            'walas_id' => $request->input('walas_id'),
            'guru_id' => $request->input('guru_id'),
            'waktu' => $request->input('waktu'),
            // 'tema' => $request->input('tema'),
            'tempat' => $request->input('tempat'),
            'status' => 'MENUNGGU..',
        ]);
    
        return response()->json(['message' => 'Success', 'data' => $jadwalbaru]);
    }
    
    public function profileSiswa(Request $request)
    {
        $siswa = Siswa::with('kelas')->where('id', $request->id)->first();
    
        $profil = [
            'id' => $siswa->id,
            'nisn' => $siswa->user->nisn_nip,
            'namasiswa' => $siswa->namasiswa,
            'kelas' => $siswa->kelas->kelas,
            'foto' => $siswa->foto,
            'tempatlahir' => $siswa->tempatlahir,
            'tanggallahir' => $siswa->tanggallahir,
            'jeniskelamin' => $siswa->jeniskelamin,
        ];
    
        return response()->json(['message' => 'Success', 'data' => $profil]);
    }
        
}
