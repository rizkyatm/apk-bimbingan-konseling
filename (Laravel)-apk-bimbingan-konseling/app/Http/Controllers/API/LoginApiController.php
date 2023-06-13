<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Konseling_bk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginApiController extends Controller
{
    public function loginApi(Request $request)
    {
        // validasi form email dan password
                $credentials = $request->only('nisn_nip', 'password');



        // membawa data user bersama relasi table murid dengan kondisi mengambil email dan menjadi $user
        // $user = User::with('murid')->where('email', $request->email)->first();
        $user = User::with("siswa")->where('nisn_nip', $request->nisn_nip)->first();

        if(Auth::attempt($credentials)){
            
            if ($user->level === 'siswa') {

                $token=$user->createToken('Personal Acces Token')->plainTextToken;
                $g = $user->murid;
                $response = [
                    'status' => 200,
                    'token' => $token,
                    'user' => $user,
                    'message' => 'Successfully Login! Welcome Back.',
                    'relasi' => $g,
                ];
                return response()->json($response);
            } else {
                $response = [
                    'status' => 500,
                    'message' => 'Anda tidak memiliki akses sebagai murid.',
                ];
                return response()->json($response);
            }
        }else if($user=='[]'){
            $response = ['status' => 500, 'message' => 'Akun tidak tersimpan dalam database'];
            return response()->json($response);
        }else{
            $response = ['status' => 500, 'message' => 'Email atau password salah! tolong coba lagi!'];
            return response()->json($response);
        }
    }   


    public function jadwal(Request $request)
    {
        $siswaId = $request->query('id');

        $jadwals = Konseling_bk::whereHas('siswa', function ($query) use ($siswaId) {
            $query->where('siswa_id', $siswaId);
        })
        ->with('siswa.user', 'guru', 'layanan_bk', 'wali_kelas')
        ->get();

        if ($jadwals->isEmpty()) {
            return response()->json(['data' => null, 'message' => 'No jadwals found for this user']);
        } else {
            return response()->json(['data' => $jadwals, 'message' => 'Success']);
        }
    }


}
